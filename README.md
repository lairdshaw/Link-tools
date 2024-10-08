## About Link Tools

Link Tools is a plugin for [MyBB](https://mybb.com/) 1.8. It extracts the links (URLs) in posts made to your forum, and then provides you with nine new features:

1. *Link previews*. Are shown at the bottom of each post for each link in the post. Supports custom "Link Previewers" to generate different previews for different types of link. Shows the preview for the terminating link rather than the original link itself.

2. *Seamless link searching*. Just type a link (URL) into the default field ("Keyword") of the standard MyBB search form and Link Tools will intercept the search and provide accurate results: only posts which contain the link or its equivalent will be listed. The default MyBB search when set to Full Text does not handle links at all well and typically returns results completely unrelated to the link for which you searched.

3. *A duplicate link warner*. When a member is starting a new thread, s/he will be warned if any links (URLs) that s/he includes in the thread-starter have already been posted to the board. This feature is especially useful when your board is heavily resource-based and there is a risk of members starting duplicate discussions about resources (links and videos) that have already been discussed.

4. *Link limiting*. Admins can set a maximum to the number of links over a (rolling) stipulated period (in days) that members of stipulated usergroups may post to a stipulated set of forums. Once the limit is reached for a given member, or would be by the new submission, submissions of new posts/threads to any of the stipulated forums by that member are rejected with an explanatory error message. The interface for adding link limit rules is in the ACP at "Forums & Posts" -> "Link Posting Limits".

5. *Link posting moderation*. Admins can set forum and usergroup permissions such that new posts containing a link and/or existing posts into which a new link is edited are subjected to moderation.

6. *Anti-link spam protection*. Admins can classify links as spam, and set an action to occur when a spam link is posted under qualifying conditions. The possible actions in increasing order of severity are to moderate the post, delete the post, and purge the link spammer either by a ban or deletion. The qualifying conditions relate to usergroup, account age, post count, and submission type (new post, edited post, or either).

7. *Automatic spam classification of links*. When posts or threads are deleted via the moderation queue, either in the ModCP or ACP, and when a spammer is purged, the moderator/admin can choose to have any links in the deleted posts/threads auto-classified as spam.

8. *Link listing*. Admins can view all links in the database. The listing can be filtered by spam classification, and searched by (partial) link. Links can individually or en masse be (re)classified as spam or not spam.

9. *Link importing*. Admins can import links into the database as plain text with one link per line, having them classified as spam (or not spam). This feature is expected to be most used for importing spam links for use by the anti-link spam protection functionality described above.

### What does Link Tools consider to be a link?

Anything that MyBB core also considers to be a link:

1. The URLs in `[url]` tags.

2. The URLs in `[video]` tags.

3. Bare URLs: those beginning with `http://`, `https://`, `ftp://`, `ftp.`, and `www.`.

### How does Link Tools determine whether one link matches another?

Link Tools handles all of the different ways in which two links can look different but be the same (resolve to the same page):

1. When they are the same except for their protocol: `http://` versus `https://`.

2. When one has a `www.` prefix and the other does not.

3. When they have the same query parameters but in a different order.

4. When one has a redundant query parameter - e.g., the `fbclid` query parameter added by Facebook - and the other does not.

5. When their domains are capitalised differently.

6. When one redirects (potentially via multiple redirects) to the other, e.g., when a URL shortening service like https://bitly.com/ is used to create a short URL which redirects to the target URL.

7. When both redirect (potentially via multiple redirects) to the same final link, e.g., when two different "shortened" URLs redirect to the same target URL.

Note that the redirects recognised by Link Tools are: HTTP redirects, HTML meta tag redirects, and "canonical" HTML link tags.

The first five differences are eliminated via "normalisation" of URLs.

The final two are eliminated by querying the URLs until the terminating URL is found. This is done using the cURL PHP functions.

## Customisation #1: adding to the ignored query parameters

As indicated above, Link Tools ignores (removes from links during normalisation) the redundant query parameters that it knows about when determining the equivalence of two links. You can find those query parameters in the file `inc/plugins/linktools/ignored-query-params.php`.

But what if you want to add more? Simply follow the instructions in the comments at the top of that file (look for the all-caps beginning "DO NOT MODIFY THIS FILE").

## Customisation #2: adding to the auto-terminating link types

The terminating links of some types of link can be determined automatically without querying those links, e.g., `youtu.be` links reliably terminate in `www.youtube.com` video links. Link Tools ships with a list of rules to this effect, which eliminate queries for some common links. You can find these rules (regular expressions and their replacements) in the file `inc/plugins/linktools/auto-term-links.php`.

As for ignored query parameters, if you want to add more rules, then simply follow the instructions in the comments at the top of that file (again, look for the all-caps beginning "DO NOT MODIFY THIS FILE").

## Customisation #3: adding custom link preview generators

Link previews are generated by classes descending from the "LinkPreviewer" class in `inc/plugins/linktools/LinkPreviewerBase.php`, and stored under `inc/plugins/linktools/link-previewers/` in either of the `link-previewers-dist` or `link-previewers-3rd-party` subdirectories. You should not add to, delete from, or otherwise modify the contents of the first of those two subdirectories, because they may change on plugin upgrades, but you are free to add your custom Link Previewers into the second of those directories (just create it if it doesn't already exist). An explanation of how to write a Link Previewer is beyond the scope of this README, but by looking at the existing Previewers, and especially the comments in their code, you will probably be able to figure it out.

## Customisation #4: adding additional cURL options

The file `inc/plugins/linktools/extra-curl-opts.php` can be created from the `extra-curl-opts.example.php` file in the same directory to stipulate additional options that should be supplied to cURL by Link Tools. These could be, for example, to stipulate an HTTP proxy server that your web host might require be used for all outgoing connections to web servers.

## Customisation #5: adding site-specific cookies

Link Tools can supply site-specific cookies based on matching a URL against site-specific regular expressions. The default regexes and their associated cookies are distributed in `inc/plugins/linktools/site-specific-cookies.php`. You or third-party developers can add your own custom files under `inc/plugins/linktools/site-specific-cookies-3rd-party/`. See the `README.md` file in that directory for more details.

## Requirements

* [The Client URL Library (cURL) for PHP](https://www.php.net/manual/en/book.curl.php).

## Licence

Link Tools is licensed under the GPL version 3.

## Installing

1. *Download*.

   Download an archive of the plugin's files.

2. *Copy files*.

   Extract the files in that archive to a temporary location, and then copy the files in "root" into the root of your MyBB installation. That is to say that "root/linktools.php" should be copied to your MyBB root directory, "root/inc/languages/english/linktools.lang.php" should be copied to your MyBB root's "inc/languages/english/" directory, etc.

3. *Install via the ACP*.

   In a web browser, open the "Plugins" module in the ACP of your MyBB installation. You should see "Link Tools" under "Inactive Plugins". Click "Install & Activate" next to it. You should then see the plugin listed under "Active Plugins" on the reloaded page.

4. *Extract links from existing posts, if any*.

   In the plugin's listing, if your board contains any posts, you will see a warning prompt to run link extraction on those posts. Click the "here" button (styled as a plain text link) to do this.

5. *Resolve terminating redirects for extracted links, if any*.

   Return to the plugin's listing, and if any links were extracted in the last step, you will see a warning prompt to run terminating link resolution on them. Again, click the "here" button (again, styled as a plain text link) to do this. Note that this will generate link previews at the same time, to save you from having to re-query all of the same links by running the "Rebuild Link Previews for Link Tools" Recount & Rebuild entry.

Optionally, you may then want to configure settings (by navigating in the ACP to "Settings" -> "Plugin Settings" -> "Link Tools Settings"), and/or edit the plugin's templates and/or its stylesheet.

## Upgrading

1. *Deactivate*.

   In a web browser, open the "Plugins" module in the ACP of your MyBB installation and click "Deactivate" beside the "Link Tools" plugin.

2. *Download and Copy files*.

   As in steps one and two for installing above.

3. *Reactivate*.

   As for step one but clicking "Activate" rather than "Deactivate".

This will maintain any settings and template changes that you've made, although if you've made template changes, you may after upgrading need to navigate in the ACP to "Templates & Style" -> "Templates" -> "Find Updated Templates" to properly integrate/update this plugin's templates.

## Debugging

If, after installing/upgrading this plugin, link previews do not appear, then you can try some basic debugging of the required [curl](https://www.php.net/manual/en/book.curl.php) PHP library using the supplied `lkt-curl-functionality-checker.php` script. Simply copy this script into your web root and then browse to it. It will output the plain-text results of its tests. In particular, if you are presented with a pattern of PASS-PASS-PASS-FAIL-PASS-FAIL, then it is likely that following the steps of [this Stack Overflow answer](https://stackoverflow.com/a/43492865) will resolve your problems.

A pattern of PASS-PASS-FAIL-FAIL-FAIL-FAIL might suggest that your web host either blocks outgoing HTTP(S) connections altogether, or requires you to direct them through an HTTP proxy, in the latter case of which you will need to perform customisation of the type #4 above. You can test the required options by editing the `$extra_opts` array at the top of the `lktcurl-functionality-checker.php` script.