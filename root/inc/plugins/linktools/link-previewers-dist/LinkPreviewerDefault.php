<?php

/**
 *  Part of the Link Tools plugin for MyBB 1.8.
 *  Copyright (C) 2021 Laird Shaw
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

// Disallow direct access to this file for security reasons.
if (!defined('IN_MYBB')) {
	die('Direct access to this file is not allowed.');
}

class LinkPreviewerDefault extends LinkPreviewer {
	/**
	 * Provisionally support all links (subject to the page to which a
	 * link refers having a content-type of text/html).
	 */
	protected $supported_norm_links_regex = '(^)';

	/**
	 * This default Previewer's priority is the lowest possible so that it does
	 * not compete with more specific Previewers.
	 */
	protected $priority = PHP_INT_MIN;

	/**
	 * This version number should be changed when link previews generated by
	 * this class change, either due its template changing or to changes to
	 * the way the values of the variables supplied to the template are
	 * generated.
	 *
	 * This signals that those link previews should be expired (when the
	 * relevant Link Tools setting is enabled) and that the template in the
	 * database needs to be updated.
	 */
	protected $version = '2.0.0';

	/**
	 * This Previewer needs the page's content and/or content-type both to
	 * determine whether it supports the page as well as to generate a
	 * preview of the page.
	 */
	protected $needs_content_for = LinkPreviewer::NC_FOR_BOTH;

	protected $friendly_name = 'Default previewer (for HTML only)';

	protected $template = '<div class="lkt-link-preview">
	<a href="{$link_safe}">
		<img src="{$pv_data[\'img_url_safe\']}" />
		{$pv_data[\'title_safe\']}<br />
		<span style="font-size: small;">{$pv_data[\'description_safe\']}</span>
	</a>
</div>';

	/**
	 * Only support previews of HTML content.
	 */
	public function supports_page($link, $content_type, $content) {
		return $content_type === 'text/html';
	}

	/**
	 * Get (after constructing it) the data required to generate the
	 * preview. This is one of the two primary functions called by
	 * consumers of this class.
	 *
	 * The data returned by this method is (for descendants of this class
	 * which support caching) cached, and in any case is supplied to the
	 * get_preview() method when the final preview needs to be generated.
	 *
	 * For a non-caching descendant class, an empty array should be
	 * returned.
	 *
	 * @param $link         The link for which the preview data should be
	 *                      generated. Is checked for validity (support).
	 * @param $content      The contents of the page at $link. May be empty
	 *                      if ($needs_content_for & NC_FOR_GEN_PV) is false
	 *                      for this Previewer.
	 * @param $content_type The content type returned for the contents of
	 *                      the previous variable ($content_type). May be
	 *                      empty if ($needs_content_for & NC_FOR_GEN_PV) is
	 *                      false for this Previewer.
	 *
	 * @return Array The data required to generate the preview based on its
	 *               template, as an array of data items indexed by string
	 *               keys.
	 */
	public function get_preview_data($link, $content, $content_type) {
		global $mybb;

		if ($content_type != 'text/html') {
			return array();
		}

		$max_title_chars = 80;
		$max_desc_chars = 83;

		$title = preg_match('(<title(?:\\s+[^>]*>|>)(.*?)</title>)sim', $content, $matches) ? $matches[1] : 'Untitled';
		$title = trim(preg_replace('(\\s+)', ' ', $title));
		$need_ellipsis_title = my_strlen($title) > $max_title_chars;
		if ($need_ellipsis_title) {
			$title = my_substr($title, 0, $max_title_chars);
		}

		$arr = preg_split('(<body[^>]*>)', $content, 2);
		if (count($arr) >= 2) {
			$body = preg_replace('(<script(?:\\s*[^>]*>|>).*?</script>)sim', ' ', $arr[1]);
			$plaintext = trim(preg_replace('(\\s+)', ' ', strip_tags($body)));
		} else {
			$body = '';
			$plaintext = '';
		}

		if (preg_match('(<meta\\s+name\\s*=\\s*"description"\\s+content\\s*=\\s*"([^"]+)")', $content, $matches)
		    ||
		    preg_match('(<meta\\s+content\\s*=\\s*"([^"]+)"\\s+name\\s*=\\s*"description")', $content, $matches)
		) {
			$description = $matches[1];
		} else	$description = $plaintext;
		$need_ellipsis_desc = my_strlen($description) > $max_desc_chars;
		if ($need_ellipsis_desc) {
			$description = my_substr($description, 0, $max_desc_chars);
		}

		if (preg_match('(<meta\\s+[^>]*property\\s*=\\s*"og:image"\\s+content\\s*=\\s*"([^"]+)")sim', $content, $matches)
		    ||
		    preg_match('(<img\\s+.*?src="([^"]*)")sim', $body, $matches)
		) {
			$img_url = lkt_check_absolutise_relative_uri($matches[1], $link);
			if (my_strlen($img_url) > 2048) {
				// More than likely this is an image whose src
				// is inline via data:image/[imagetype] - ignore
				// it as it wastes DB space.
				$img_url = '';
			}
		}
		if (!$img_url) {
			$img_url = $mybb->settings['bburl'].'/images/image-placeholder-icon.png';
		}

		$title_safe = $this->make_safe($title);
		if ($need_ellipsis_title) $title_safe .= '&hellip;';
		$description_safe = $this->make_safe($description);
		if ($need_ellipsis_desc) $description_safe .= '&hellip;';
		$img_url_safe = $this->make_safe($img_url);

		return array('title_safe' => $title_safe, 'description_safe' => $description_safe, 'img_url_safe' => $img_url_safe);
	}
}