=== Based On Post ===
Contributors: MelvinSoftware
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=DSRMH3GCX7LD8
Tags: post meta, meta, based on post, melvin software, melvinsoftware, post content
Author URI: http://www.melvinsoftware.com
Plugin URI: http://www.melvinsoftware.com/589/based-on-post 
Requires at least: 3.0.0
Tested up to: 3.5.1
Stable tag: 2.0

Based On Post is designed to let users and developers make use of their Theme's sidebars by enabling dynamic content that can be changed by post.

== Description ==

Have you ever wanted to display content on your Wordpress sidebar, but not have it be the same content across your entire site?
How about displaying an image gallery for each individual post on the sidebar? Or having information specific to the
subject of that particular post displayed?

Based On Post let's you do just that. This simple, but extremely useful Wordpress plugin is designed to let you place a widget on a single sidebar of
your wordpress blog, (in the furture, multiple sidebars will be supported), and for each post or page, specify the text or HTML code that is to go in the widget. The input box for the data
is on the Post or Page writing screen.

**UPDATED**
Now you can also add Based On Post to your Templates instead of your Sidebar. It still relies on data being entered in the fiels inside the
Create Post or Create Page screens. To add it to your template, open one of the template files either in the editor of your choice or inside
wordpress itself, and add the following code to your template file:   `<?php do_action( 'msbop_template_tag' ); ?>`  

Friendly Tip: You should only use Template Tags if you know how to edit your PHP code...wrongly placed code can mess up your site!

**Features**
* Display arbitrary information based on the page that the visitors view, instead of the same content throughout your site.  

* Use Post title as the widget title, or use your own custom title.  

* Use HTML, Plain Text, even scripts and shortcodes in the widget!  

**Options**  

*You will find the option for using the Post Title as the Widget Title in the widget box when you add it to your sidebar.

== Installation ==

1. Download the zip file from the wordpress repository
2. Upload the folder 'based-on-post' to the '/wp-content/plugins/' directory  

*Alternativly to 1 and 2, add the plugin through wordpress itself.

3. Activate the plugin through the 'Plugins' menu in WordPress
4. Go to your 'Widgets' Menu, and place the 'Based On Post' widget in the sidebar where you would like your content to appear
5. Go to any Post or Page, or create a new one, and find the newly added 'Based On Post' Section. (It may be hidden at first,
to make it visible, click 'Screen Options' at the top, and ensure 'Based on Post' is checked)
6. Input your custom Title and Text or HTML in the input form.
7. Update/Publish your content.
8. View your Website and look for your new content in the position of the widget.

== Frequently Asked Questions ==

= I can't find the Based On Post input box on my 'Add Post' or 'Add Page' screen. =

Please make sure that you've placed a checkmark next to it under the 'screen options' tab inside the
'Add Post' or 'Add Page' screen. Sometimes wordpress automatically hides extra fields.

= The Widget always uses the Post title instead of my own custom Title. =

To turn the 'Post Title as Widget Title' option on or off, go to the 'Appearance->widgets' section of your wordpress
dashboard, and open the 'Based On Post' Widget. There is a single checkbox to turn it on or off. (see Screenshot 1)

== Screenshots ==

1. The Widget inside the 'Widget' options page
2. The Based On Post text input box on the post/page add screen

== Changelog ==

= 2.0 =
* Added support for Custom Post Types, as requested by users.

= 1.2 =
* Added the requested Ability to Use a Template Tag to display the data from Based On Post in your template.

= 1.1 =
* Updated the way the Widget displays. Will now only display on Single Posts and pages, to prevent it from showing up where several pages or posts are listed.
* Changed how the plugin handles deactivation/uninstallation. Will now keep all entered data after activation, will remove all associated data on uninstallation/deletion.

= 1.0 =
* First Stable Release Version.
* Ability to add a single Based On Post widget to the sidebar.
* Shortcodes Added

= 0.5 =
* Development and Testing.

== Upgrade Notice ==

= 1.0 to 1.1 =
* Updated the way the Widget displays so that it will now only display on Single Posts and pages. 
No more showing up where several pages or posts are listed. Also changed how the plugin handles deactivation/uninstallation.