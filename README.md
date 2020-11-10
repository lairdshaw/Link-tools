## About Link Tools

Link Tools is a plugin for [MyBB](https://mybb.com/) 1.8. It extracts the links (URLs) in posts made to your forum, and then provides you with two new features:

1. *Seamless link searching*. Just type a link (URL) into the default field ("Keyword") of the standard MyBB search form and Link Tools will intercept the search and provide accurate results: only posts which contain the link or its equivalent will be listed. The default MyBB search does not handle links at all well and typically returns results completely unrelated to the link for which you searched.

2. *A duplicate link warner*. When a member is starting a new thread, s/he will be warned if any links (URLs) that s/he includes in the thread-starter have already been posted to the board. This feature is especially useful when your board is heavily resource-based and there is a risk of members starting duplicate discussions about resources (links and videos) that have already been discussed.

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

   Return to the plugin's listing, and if any links were extracted in the last step, you will see a warning prompt to run terminating link resolution on them. Again, click the "here" button (again, styled as a plain text link) to do this.

Optionally, you may then want to configure settings (by navigating in the ACP to "Settings" -> "Plugin Settings" -> "Link Tools Settings"), and/or edit the plugin's templates and/or its stylesheet.

## Upgrading

1. *Deactivate*.

   In a web browser, open the "Plugins" module in the ACP of your MyBB installation and click "Deactivate" beside the "Link Tools" plugin.

2. *Download and Copy files*.

   As in steps one and two for installing above.

3. *Reactivate*.

   As for step one but clicking "Activate" rather than "Deactivate".

This will maintain any settings and template changes that you've made, although if you've made template changes, you may after upgrading need to navigate in the ACP to "Templates & Style" -> "Templates" -> "Find Updated Templates" to properly integrate/update this plugin's templates.