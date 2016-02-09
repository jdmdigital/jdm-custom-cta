# JDM Custom CTA
This simple, unbranded WordPress plugin adds Call-to-Action (CTA) fields to the editor and allows theme developers to display it using simple functions.  More information can be found on [JDM Labs](http://labs.jdmdigital.co/code/jdm-custom-cta/ "JDM Labs").

![alt tag](http://labs.jdmdigital.co/wp-content/uploads/sites/4/2016/02/cta-banner-big-770x400.png)

## Description
There are many cases when theme developers may want the ability to add a call-to-action (or CTA) button to their theme that's easily editable from the WordPress backend. Originally created for a client, this reusable plugin does just that.

The plugin does **NOT** enqueue any resources or make any significant change to the speed of the site. It simply adds this handy functionality using a custom post meta box and give theme developers a new function they can use in their themes.

## Installation
1. [Download the plugin here](http://labs.jdmdigital.co/wp-content/uploads/sites/4/2016/02/jdm-custom-cta.zip "Download v0.5 from JDM Labs") or from this GitHub repo (choose ZIP)
2. Install the plugin, and the updater - [tutorial here for using GitHub Updater](http://labs.jdmdigital.co/plugins/github-updates/)
3. Activate the plugin
4. Go to one of your Pages or "Add New Page"
5. Look for the new post meta box titled Call to Action (CTA) under the WYSIWYG editor
6. Enter the URL where you want the CTA to link to, starting with http://
7. Enter the text you want the button to say, for example: “Click Here for Awesome Stuff”
8. Publish or Update the page

**NOTE**: That just sets the post meta for us to use our handy functions.  You still have to add the actual functions to show the information in your theme.  See a full example on [the plugin site](http://labs.jdmdigital.co/code/jdm-custom-cta/ "JDM Labs") for details on how to display your new Call-to-Action button in your themes.

## Frequently Asked Questions

**Why isn't my CTA links showing up?**
You need to make sure you add the PHP code to your theme in the location you want it.  See a full example on [the plugin site](http://labs.jdmdigital.co/code/jdm-custom-cta/ "JDM Labs") for details on how to display your new Call-to-Action button in your themes.

**How do I remove the CTA button?**
Easy.  Just delete the link in the page editor and click "Update."  If there is no link for the CTA to link to, the `have_cta()` function will return false.  That's true even if the CTA button text is still there.

**Why does my CTA button always say "Click Here"**
Oh, that's the default.  If you don't set a value in the CTA Button Text, it'll default to "Click Here."  We know that's a terrible Call-to-Action.  That's why it's the default--to encourage you to set it to something relevant.

## Changelog

<<<<<<< HEAD
**0.9**
* ALPHA testing complete.
* Small edits to source code and readme file(s)

**0.5**
* Enabled GitHub Updater
* Small edits to source code and readme file(s)
=======
**0.5**
* GitHub Updater enabled for automatic updates.
>>>>>>> origin/master

**0.2**
* Reusable plugin created.
* Version updated.

**0.1**
* Initial Release.
