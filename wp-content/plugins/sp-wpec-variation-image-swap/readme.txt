=== SP WPEC Variation Image Swap ===
Contributors: splashingpixels.com
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=3LNUSMYGTCP7Y
Tags: wpec, wp-e-commerce, variation image, image swap, variation image swap, splashing pixels
Requires at least: 3.0
Tested up to: 3.5.1
Stable tag: 2.0.7

Plugin that adds product variation image swapping function to Wordpress e-Commerce plugin (WPEC). Requires 3.8+ of WPEC plugin.

== Description ==

This plugin enables products with variation images to be swapped in place of the main product thumbnail when users changes the variation dropdown selection option.  This way users can see different images of your product based on the variation chosen.  For example, you may have a variation named "color" and you have set different color product variation images for them.  This plugin will correctly swap out the main product image, with the color, the user selected.

See demo here-> http://splashingpixels.com/plugins/wpec-variation-image-swap/

For plugin support, please do not post support questions here on WordPress.org but instead post it in our support forum so we can better help you.  You can sign up to become a member on our site http://splashingpixels.com -- it's FREE!

== Installation ==
1. Be sure Wordpress e-Commerce (WPEC) plugin is already installed.
2. Upload the folder `sp-wpec-variation-image-swap` to the `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Option to turn off image swap per product basis.  See below FAQ and screentshot.

== Frequently Asked Questions ==

= Image is not swapping when I select one variation =

Remember that variations are in combinations, so all selects must be selected once for the system to know which image to grab for you.  For example you have a product called T-shirt and it has 3 colors and 3 sizes.  The user would select large and then red for example.  Then the image for that combination will be retrieved.  From then on if they just select a different color, it will also work as it will look for the next color with the size large.

= How do I turn off image swap for only certain products? =

Check the checkbox in the sidebar widget that says "Disable Variation Image Swap". and click on Update/Save.  See screenshot 1

= I did everything but it is still not working! What gives!? =

It is possible the theme you're using is not compatible with the plugin if the theme has changed any class/id names on certain containers.  To know for sure, switch to 2011 default Wordpress theme and re-test.

== Screenshots ==

1. This screen shot shows an option to turn off image swapping per product basis.

== Changelog ==

= 2.0.7 =
* Fixed - Image swap was affecting WPEC product specials widget

= 2.0.6 =
* Fixed - after the image swap, clicking on lightbox shows the small size of the image instead of the large
* Fixed - when no image is found, sometimes wrong image is loaded in default

= 2.0.5 =
* Update - removed the dependency of Timthumb for compatibility
* Update - removed the image file size check with getimagesize function as it is no longer needed without timthumb

= 2.0.4 =
* Update - added a check to see if hosting server allows url fopen, if not, use curl.

= 2.0.3 =
* Update - changed a selector name in the swap script to prevent compatibility issues with other plugins

= 2.0.2 =
* Fixed - when image is swapping it sometimes stutters and flashes the old image before being replaced

= 2.0.1 =
* Update - restructured the plugin folders

= 2.0 =
* Update - plugin has been completely re-written with OOP technique for future extendibility 

= 1.0.2 =
* Update - Timthumb version to 2.8.10

= 1.0.1 =
* Update - FAQ
* Update - Added underscore to the meta key to prevent product custom fields to pick it up.
* Update - No longer need to jump through loops to enable/disable the image swap function. It now works as it should

= 1.0 =
* Release

== Upgrade Notice == 

= 1.0.1 =
Added/Updated new features

= 1.0 =
Release