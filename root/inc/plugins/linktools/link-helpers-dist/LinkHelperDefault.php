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

class LinkHelperDefault extends LinkHelper {
	/**
	 * Support all links.
	 */
	static protected $supported_norm_links_regex = '(^)';

	/**
	 * This default Helper's priority is the lowest possible so that it does
	 * not compete with more specific Helpers.
	 */
	static protected $priority = PHP_INT_MIN;

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
	static protected $version = '1.0.0';

	protected $friendly_name = 'Default helper';

	protected $template = '<div class="lkt-link-preview">
	<a href="$link_safe">
		<img src="$img_url" />
		$title_safe<br />
		<span style="font-size: small;">$description_safe</span>
	</a>
</div>';

	/**
	 * The heart of the class.
	 */
	protected function get_preview_contents($link, $content, $content_type) {
		global $mybb;

		if ($content_type != 'text/html') {
			return '';
		}

		$max_title_chars = 80;
		$max_desc_chars = 83;

		$title = preg_match('(<title(?:\\s+[^>]*>|>)(.*?)</title>)sim', $content, $matches) ? $matches[1] : 'Untitled';
		$title = trim(preg_replace('(\\s+)', ' ', $title));
		$need_ellipsis_title = strlen($title) > $max_title_chars;
		if ($need_ellipsis_title) {
			$title = substr($title, 0, $max_title_chars);
		}

		if (preg_match('(<meta\\s+name\\s*=\\s*"description"\\s+content\\s*=\\s*"([^"]+)")', $content, $matches)
		    ||
		    preg_match('(<meta\\s+content\\s*=\\s*"([^"]+)"\\s+name\\s*=\\s*"description")', $content, $matches)
		) {
			$description = $matches[1];
		} else {
			$arr = preg_split('(<body[^>]*>)', $content, 2);
			if (count($arr) >= 2) {
				$body = preg_replace('(<script(?:\\s*[^>]*>|>).*?</script>)sim', ' ', $arr[1]);
				$plaintext = trim(preg_replace('(\\s+)', ' ', strip_tags($body)));
				$description = $plaintext;
			} else	$description = '';
		}
		$need_ellipsis_desc = strlen($description) > $max_desc_chars;
		if ($need_ellipsis_desc) {
			$description = substr($description, 0, $max_desc_chars);
		}

		if (preg_match('(<meta\\s+[^>]*property\\s*=\\s*"og:image"\\s+content\\s*=\\s*"([^"]+)")sim', $content, $matches)
		    ||
		    preg_match('(<img\\s+.*?src="([^"]*)")sim', $content, $matches)
		) {
			$img_url = lkt_check_absolutise_relative_uri($matches[1], $link);
		} else	$img_url = $mybb->settings['bburl'].'/images/image-placeholder-icon.jpg';

		$link_safe = htmlspecialchars_uni($this->make_safe($link));
		$title_safe = $this->make_safe($title);
		if ($need_ellipsis_title) $title_safe .= '&hellip;';
		$description_safe = $this->make_safe($description);
		if ($need_ellipsis_desc) $description_safe .= '&hellip;';
		$img_url_safe = $this->make_safe($img_url);

		eval('$preview_contents = "'.$this->get_template_for_eval().'";');

		return $preview_contents;
	}
}
