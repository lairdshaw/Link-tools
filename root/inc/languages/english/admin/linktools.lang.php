<?php

$l['lkt_name'             ] = 'Link Tools';
$l['lkt_desc'             ] = 'Keeps track of links (URLs) in posts and then provides three link services: (1) link previews, (2) seamless link searching, and (3) warning a member if a link in a thread they are about to start has already been shared to the forum.';
$l['lkt_successful_upgrade_msg_for_info'  ] = 'Successfully upgraded to version {1}.';
$l['lkt_successful_upgrade_msg'           ] = 'The {1} plugin has been activated successfully and upgraded to version {2}.';
$l['lkt_needdbupgrade1'                   ] = 'Database changes required. Click <a href="index.php?module=config-plugins&amp;action=lkt_dbupgrade1">here</a> to make them.';
$l['lkt_needdbupgrade2'                   ] = 'Database changes required. Activate the plugin and then click the provided link.';

$l['lkt_all_links_extracted'              ] = ' All {1} links have been successfully extracted from all {2} posts.';
$l['lkt_x_of_y_posts_unextracted'         ] = '{1} of {2} posts have not yet had links extracted from them.';
$l['lkt_to_extract_links_click_here'      ] = ' To extract links from that/those {1} post(s), click {2}here{3} (or simply leave it up to the scheduled Link Tools task, assuming you have not disabled it). Note that at the end of the process, the success message will read "Successfully repopulated the links tables for Link Tools." Rest assured that despite that message, when that function is run from here the links table is not repopulated from scratch: links are extracted only from the aforementioned posts from which links have not yet been extracted; posts from which links have already been extracted are left untouched.';
$l['lkt_all_term_links_resolved'          ] = 'Terminating links have been successfully resolved for all extracted links.';
$l['lkt_x_of_y_links_unresolved'          ] = '{1} of {2} links have not been resolved into their terminating links.';
$l['lkt_attempts_unsuccess_made_all_links'] = ' Attempts have been unsuccessfully made for all {1} of them.';
$l['lkt_attempts_unsuccess_made_x_links'  ] = ' Attempts have been unsuccessfully made for {1} of them.';
$l['lkt_given_up_on_x_links'              ] = ' We\'ve given up on {1} of them.';
$l['lkt_to_resolve_links_click_here'      ] = ' {1} link(s) is/are eligible for a resolution attempt right now by clicking {2}here{3}. Note that at the end of the process, the success message will read "Successfully repopulated the terminating redirects in the links table for Link Tools." Rest assured that despite that message, when that function is run from here the links table is not repopulated from scratch: only the aforementioned eligible unresolved links are resolved; already-resolved links are left untouched.';
$l['lkt_no_links_eligible_for_resolution' ] = ' None of these links is eligible for another resolution attempt right now: reattempts of failed resolutions are subject to staggered delays as there is typically no point in retrying immediately; instead, the need is to wait for any network/server problem(s) to be fixed.';

$l['lkt_rebuild_links'     ] = 'Rebuild Link Tables For Link Tools';
$l['lkt_rebuild_links_desc'] = 'When this is run, the database tables that store the links from within posts are repopulated from scratch. Generally, the only reason to run this rebuild is to initialise the tables immediately after the plugin is first installed, because the plugin also installs a task that periodically "catches up" with any posts whose links have not yet been extracted and stored. After running this rebuild, you will then need to run the subsequent rebuild, "Repopulate Terminating Redirects For Link Tools", since the information about terminating redirects will be deleted when this rebuild runs.';
$l['lkt_admin_log_rebuild_links'] = 'Repopulating the links tables for Link Tools.';
$l['lkt_success_rebuild_links'] = 'Successfully repopulated the links tables for Link Tools.';

$l['lkt_rebuild_terms'     ] = 'Repopulate Terminating Redirects For Link Tools';
$l['lkt_rebuild_terms_desc'] = 'When this is run, the terminating redirects for links in the database are repopulated from scratch (regeneration of link previews for those terminating redirects comes along for the ride too). This ensures that any stored terminating redirects that may have changed since the posts were first made are updated. Be cautious about changing the "Data Entries Per Page" setting (to the right of this text), which determines the (maximum) number of web servers queried simultaneously when resolving redirects - setting it too high might cause failures.';
$l['lkt_admin_log_rebuild_terms'] = 'Repopulating the terminating redirects in the links tables for Link Tools.';
$l['lkt_success_rebuild_terms'] = 'Successfully repopulated the terminating redirects in the links table for Link Tools.';

$l['lkt_rebuild_renorm'     ] = 'Renormalise Links For Link Tools';
$l['lkt_rebuild_renorm_desc'] = 'When this is run, stored links are renormalised. This only needs to be run if the "ignored query parameters" array is changed. For details on how to change that array, see inc/plugins/linktools/ignored-query-params.php.';
$l['lkt_admin_log_rebuild_renorm'] = 'Renormalising links for Link Tools.';
$l['lkt_success_rebuild_renorm'] = 'Successfully renormalised links for Link Tools.';

$l['lkt_rebuild_linkpreviews'     ] = 'Rebuild Link Previews for Link Tools';
$l['lkt_rebuild_linkpreviews_desc'] = 'When this is run, link previews are (re)generated for all terminating links in the database. Whether link previews are (re)generated for all terminating links or only for those which do not already exist or are invalid can be controlled via the Link Tools setting "Scope of Rebuild Link Previews entry".';
$l['lkt_admin_log_rebuild_linkpreviews'] = 'Rebuilding link previews for Link Tools.';
$l['lkt_success_rebuild_linkpreviews'] = 'Successfully rebuilt link previews for Link Tools.';

$l['lkt_task_title'       ] = 'Link Tools Link Extraction And Redirect Resolution';
$l['lkt_task_description' ] = 'Extracts links from any posts from which links have not already been extracted, and stores them into the database. Then resolves ultimate redirect targets for up to '.lkt_default_rebuild_term_items_per_page.' links for which an ultimate redirect target has not yet already been resolved, and stores those targets into the database. The first part of this task is most useful in cases in which the plugin is deactivated for a period, during which new posts will not have their links extracted by the plugin - this task then "catches up" on those posts when the plugin is reactivated. On top of that scenario, the second part of this task is necessary because even though redirect targets are resolved when links are first extracted and stored after being edited into a new or existing post, there can sometimes be network errors or downed sites which prevent proper resolution of any redirect(s) at the time.';
$l['lkt_task_ran'         ] = 'The Link Tools link extraction and redirect resolution task successfully ran.'; // duplicated in ../linktools.php

$l['lkt_enable_dlw_title' ] = 'Enable the duplicate link warner?';
$l['lkt_enable_dlw_desc'  ] = 'When enabled, a member posting a new thread will be warned if any links in their thread-starter have already been posted to the forum in one or more existing posts.';

$l['lkt_settings'         ] = 'Link Tools Settings';
$l['lkt_settings_desc'    ] = 'Settings to customise the Link Tools plugin';

$l['lkt_force_dlw_title'  ] = 'Force members to use the duplicate link warner?';
$l['lkt_force_dlw_desc'   ] = 'When set to "Yes", a member posting a new thread will not be permitted to disable the duplicate link warner. Otherwise, members may uncheck a "Warn about duplicate links" checkbox while posting a new thread to disable the duplicate link warner. The value of this checkbox persists across pages and sessions - it is stored in the member\'s settings.';

$l['lkt_link_preview_type_title'    ] = 'Link preview domains';
$l['lkt_link_preview_type_desc'     ] = 'The domains for which to enable link previews:';
$l['lkt_link_preview_type_all'      ] = 'All domains';
$l['lkt_link_preview_type_none'     ] = 'No domains';
$l['lkt_link_preview_type_whitelist'] = 'Only the following domains (whitelist)';
$l['lkt_link_preview_type_blacklist'] = 'All domains except the following (blacklist)';

$l['lkt_link_preview_dom_list_title'] = 'Link preview domain whitelist/blacklist';
$l['lkt_link_preview_dom_list_desc' ] = 'The domain whitelist/blacklist for the previous setting (if applicable). One domain per line.';

$l['lkt_link_preview_disable_self_dom_title'] = 'Self-domain disable?';
$l['lkt_link_preview_disable_self_dom_desc' ] = 'Disable link previews for links within this board\'s domain?';

$l['lkt_link_preview_active_forums_title'   ] = 'Link preview forums';
$l['lkt_link_preview_active_forums_desc'    ] = 'The forums for which to enable link previews.';

$l['lkt_link_preview_active_post_type_title'] = 'Link preview post type';
$l['lkt_link_preview_active_post_type_desc' ] = 'The type of posts for which to enable link previews.';
$l['lkt_link_preview_active_post_first'     ] = 'First post';
$l['lkt_link_preview_active_post_replies'   ] = 'Replies';
$l['lkt_link_preview_active_post_both'      ] = 'Both (all posts)';

$l['lkt_link_preview_expiry_period_title'   ] = 'Link preview expiry period';
$l['lkt_link_preview_expiry_period_desc'    ] = 'The number of days after which a link preview should be expired (and regenerated on demand). Zero indicates "Never expire".';

$l['lkt_link_preview_expire_on_new_previewer_title'] = 'Expire link previews on previewer change?';
$l['lkt_link_preview_expire_on_new_previewer_desc' ] = 'Whether or not a link preview should be expired (and regenerated on-demand) when the previewer which originally generated it is changed, or when a new, higher priority previewer applies to the link. Choose "Yes" for expiry and "No" to leave such link previews unexpired. Note that this setting does not affect link previewers which are selected and prioritised based on the page\'s content or content type, since their selection requires a query of a link\'s web server, defeating the purpose of using the cache where possible.';

$l['lkt_link_preview_on_fly_title'] = 'On-the-fly link preview (re)generation domains';
$l['lkt_link_preview_on_fly_desc' ] = 'When viewing a thread with links without a valid cached preview in the database, for which domains should a link preview be (re)generated on the fly? Does not apply to initial on-the-fly generation of link previews (which are then cached in the database) during posting, which cannot be disabled except via disabling link previews for the relevant link previewer types / domains entirely.';
$l['lkt_link_preview_on_fly_always' ] = 'All domains';
$l['lkt_link_preview_on_fly_never' ] = 'No domains';
$l['lkt_link_preview_on_fly_whitelist'] = 'Only for the following domains (whitelist)';
$l['lkt_link_preview_on_fly_blacklist'] = 'For all domains except the following domains (blacklist)';

$l['lkt_link_preview_on_fly_dom_list_title'] = 'On-the-fly domain whitelist/blacklist';
$l['lkt_link_preview_op_fly_dom_list_desc' ] = 'The domain whitelist/blacklist for the previous setting (if applicable). One domain per line.';

$l['lkt_link_preview_rebuild_scope_title'       ] = 'Scope of Rebuild Link Previews entry';
$l['lkt_link_preview_rebuild_scope_desc'        ] = 'For which links should previews be rebuilt by the "Rebuild Link Previews for Link Tools" Recount & Rebuild entry?';
$l['lkt_link_preview_rebuild_scope_all'         ] = 'All';
$l['lkt_link_preview_rebuild_scope_only_invalid'] = 'Only links with missing/invalid/expired previews';

$l['lkt_link_preview_not_in_quotes_title'] = 'Exclude quoted links from preview?';
$l['lkt_link_preview_not_in_quotes_desc' ] = 'Set to "Yes" to prevent previews from being generated for links within MyBB quote tags.';

$l['lkt_link_preview_skip_if_contains_img_title'] = 'Exclude [url] tags enclosing [img] tags from preview?';
$l['lkt_link_preview_skip_if_contains_img_desc'] = 'Set to "Yes" to prevent previews from being generated for links for [url] tags that enclose [img] tags (if, for example, in these cases an enclosed image serves as a sufficient preview for your purposes).';

$l['lkt_linkpreviewers'    ] = 'Link Previewers';
$l['lkt_template_installed'] = 'Template installed?';
$l['lkt_previewer_enabled' ] = 'Enabled?';
$l['lkt_previewer_name'    ] = 'Previewer name';
$l['lkt_update'            ] = 'Update Link Previewers';
$l['lkt_missing_hlp_name'  ] = '"{1}" (Class name; previewer file missing so friendly name unknown)';

// One or the other of these two strings...
$l['lkt_previewers'        ] = '{1} link previewers';
$l['lkt_one_previewer'     ] = '1 link previewer';
// ...will replace {1} in this string:
$l['lkt_need_inst_previewers'] = 'Necessary templates need to be installed for {1}. Click {2}here{3} to install them.';

$l['lkt_preview_previewer_tpl_chg_pg_title'] = 'Invalidate link preview cache for "{1}"?';
$l['lkt_preview_previewer_tpl_chg_pg_heading'] = 'Invalidate link preview cache for <em>{1}</em>?';
$l['lkt_invalidate_previewer_msg'] = 'You have just successfully edited the template for the Link Previewer <em>{1}</em>. This Previewer generates link previews and caches them. Unless you invalidate the already-cached link previews for this Previewer, your changes to this template will not affect them unless/until they naturally expire, and will only affect the previews it generates from here on. Click below if you would like to invalidate this Previewer\'s preview cache so that your changes take effect for its already-cached previews. Note though that for invalidated link previews to then be rebuilt, you will need to either:<ul><li>Ensure that the Link Tools plugin\'s <em>On-the-fly link preview (re)generation domains</em> <a href="index.php?module=config-settings&action=change&amp;gid={2}">setting</a> is set to a value which ensures that this Previewer\'s previews are regenerated on the fly, or,</li><li>Rebuild the link preview cache at <em><a href="index.php?module=tools-recount_rebuild">Tools &amp; Maintenance</a></em> » <em>Rebuild Link Previews for Link Tools</em>.</li></ul>';

$l['lkt_inval_pv_cache_for'] = 'Invalidate the link preview cache for "{1}"';

$l['lkt_linkpreviewers_cache_invalidation'    ] = 'Link Preview Cache Invalidation';
$l['lkt_linkpreviewers_cache_invalidation_msg'] = 'Invalidate Cached Link Previews for the Previewer:';
$l['lkt_all'                       ] = '[All]';
$l['lkt_linkpreviewers_invalidated'] = 'The link preview caches of the following Previewers were invalidated: {1}';
$l['lkt_go_back_link_txt'          ] = '« Go back to where you were';

$l['lkt_linklimits'] = 'Link Posting Limits';
$l['lkt_linklimitsdesc'] = 'For each row of settings, those members who are in any of the listed user groups may not post to the listed forums more than the maximum allowed links during the period in days. The limit applies across the set of forums, not to each of the forums individually. Sub-forums of selected forums are not included unless selected too. Selected categories are ignored: to include all of the sub-forums of a category, select them individually. All user groups of a member are checked - both primary and additional. If multiple limits apply to a member, all are checked; if any one of them would prohibit the member from posting, then s/he is prohibited.';
$l['lkt_groups'    ] = 'Affected user groups';
$l['lkt_maxlinks'  ] = 'Maximum allowed links';
$l['lkt_days'      ] = 'Period (in days)';
$l['lkt_forums'    ] = 'Affected forums (collectively)';
$l['lkt_action'    ] = 'Action';
$l['lkt_delete'    ] = 'Delete';
$l['lkt_add'       ] = 'Add';
$l['lkt_err_nogrps'] = 'You did not select any groups.';
$l['lkt_err_nofrms'] = 'You did not select any forums.';
$l['lkt_err_nodays'] = 'You did not enter an integer of one or more for the period in days.';
$l['lkt_err_nomaxlnk'] = 'You did not enter an integer of zero or more for the maximum links.';
