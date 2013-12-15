=== R3DF Meetup Widget ===
Contributors: r3df
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=MX3FLF4YGXRLE
Tags: meetup, meetups, meetup.com, widget, meetup widget
Stable tag: 1.0.8
Requires at least: 3.3
Tested up to: 3.8
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A simple widget for displaying a link to a meetup.com group.

== Description ==
A simple widget for use with a [Meetup.com](http://meetup.com) group.  The plugin adds a widget that shows a link to your Meetup group.

Simply enter your Meetup group name and it's URL and save.  You can display the widget with or without a title.

**Support**

Support for this plugin is limited to fixing _confirmed bugs_ and improving the plugin with enhancements that can be reasonably accommodated.

This plugin is provided under the terms of the GPL, which includes the following passage:

> BECAUSE THE PROGRAM IS LICENSED FREE OF CHARGE, THERE IS NO WARRANTY
> FOR THE PROGRAM, TO THE EXTENT PERMITTED BY APPLICABLE LAW.  EXCEPT WHEN
> OTHERWISE STATED IN WRITING THE COPYRIGHT HOLDERS AND/OR OTHER PARTIES
> PROVIDE THE PROGRAM "AS IS" WITHOUT WARRANTY OF ANY KIND, EITHER EXPRESSED
> OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
> MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE.  THE ENTIRE RISK AS
> TO THE QUALITY AND PERFORMANCE OF THE PROGRAM IS WITH YOU.  SHOULD THE
> PROGRAM PROVE DEFECTIVE, YOU ASSUME THE COST OF ALL NECESSARY SERVICING,
> REPAIR OR CORRECTION.

== Installation ==
The easy way:

1. To install this plugin, click on "Add New" on the plugins page in your WordPress dashboard.
2. Search for "R3DF Meetup Widget", click install when it's found.
3. Activate the plugin through the 'Plugins' menu in WordPress.
4. Use the Widget panel to place and configure this widget in a sidebar.

The hard way:

1. Download the latest r3df-meetup-widget.zip from wordpress.org
2. Upload r3df-meetup-widget.zip to the `/wp-content/plugins/` folder on your web server
3. Uncompress r3df-meetup-widget.zip (delete r3df-meetup-widget.zip after it's uncompressed)
4. Activate the plugin through the 'Plugins' menu in WordPress
5. Use the Widget panel to place and configure this widget in a sidebar


== Screenshots ==

1. The widget admin.
2. The widget on the site.


== Changelog ==

= 1.0.8 =
1. Added option to launch meetup link in a new window.

= 1.0.7 =
1. Reverted register_widget call to 1.0.5 version, anonymous functions are PHP 5.3+ only, WP still supports 5.2
2. Adjusted CSS to fix rendering bug in FireFox

= 1.0.6 =
1. Updated constructor
2. Updated some code to current WP conventions
3. Added code comments

= 1.0.5 =
1. Removed closing ?>

= 1.0.4 =
1. CSS tweak
2. Removed more capitals in file names

= 1.0.3 =
1. Changed to PHP5 __contruct.
2. Removed capitals in file name

= 1.0.2 =
1. Added uninstall routine to remove saved settings.

= 1.0.1 =
1. Tweaked CSS to fix height bug when used with title.
2. Updated image - cleaner copy from official PSD.

= 1.0.0 =
Initial Release




