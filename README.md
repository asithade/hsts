# HSTS

## Disclaimer
This plugin was originally created by [Peter Shaw](https://profiles.wordpress.org/shawfactor) and [I've](https://github.com/asithade) just modified it and made it more user friendly and structured.

## Description

DS HSTS is HTTP Strict Transport Security Wordpress Plugin, a means to enforce using SSL even if the user accesses the site through HTTP and not HTTPS.

This plugin send the proper headers for full ssl security. For more information on what this is and why it is important visit: http://en.wikipedia.org/wiki/HTTP_Strict_Transport_Security

The options are preset to enable browsers to preload to the HSTS directive but can be changed in the options page.

## Installation

1. Upload the entire `ds-hsts` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.

## Frequently Asked Questions

#### How do I change the behaviour of this plugin?

* Go to Settings > HSTS to change the options.

## Changelog

##### 1.00 - February 28, 2016
* Initial release

##### 1.10 - March 28, 2016
* Use correct domain

##### 1.11 - April 02, 2017
* Added class exists check

##### 1.2 - May 11, 2017
* Just made everything look pretty and structured

##### 1.0 - May 15, 2017
* Filters are annoying, so I got rid of them
