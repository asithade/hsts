# LH HSTS

## Disclaimer
This plugin was originally created by [Peter Shaw](https://profiles.wordpress.org/shawfactor) and [I've](https://github.com/asithade) just modified it and made it more user friendly and structured.

## Description

HSTS is HTTP Strict Transport Security, a means to enforce using SSL even if the user accesses the site through HTTP and not HTTPS.

This plugin send the proper headers for full ssl security. For more information on what this is and why it is important visit: http://en.wikipedia.org/wiki/HTTP_Strict_Transport_Security

The options are preset to enable browsers to preload the HSTS directive but can be overwritten by filters which are clearly documented in the code.

#### Did you find this plugin helpful? Please consider [writing a review](https://wordpress.org/support/view/plugin-reviews/lh-hsts).##

## Installation

1. Upload the entire `lh-hsts` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.

## Frequently Asked Questions

#### How do I change the behaviour of this plugin?

Through filters, all of which are commented in the code and will be documented below.

##### To update the max-age settings, add the following code to your `functions.php`
```
add_filter('lh_hsts_max_age', 'modify_ls_hsts_max_age_func');

function modify_ls_hsts_max_age_func( $max_age ){
	return false;
}
```

##### To update the subdomain settings, add the following code to your `functions.php`
```
add_filter('lh_hsts_subdomain', 'modify_ls_hsts_subdomain_func');

function modify_ls_hsts_subdomain_func( $subdomain ){
	return false;
}
```

##### To update the preload setting, add the following code to your `functions.php`
```
add_filter('lh_hsts_preload', 'modify_ls_hsts_preload_func');

function modify_ls_hsts_preload_func( $preload ){
	return false;
}
```

##### To update the redirect setting, add the following code to your `functions.php`
```
add_filter('lh_hsts_redirect', 'modify_ls_hsts_redirect_func');

function modify_ls_hsts_redirect_func( $redirect ){
	return false;
}
```

## Changelog

##### 1.00 - February 28, 2016
* Initial release

##### 1.10 - March 28, 2016
* Use correct domain

##### 1.11 - April 02, 2017
* Added class exists check

##### 1.2 - May 11, 2017
* Just made everything look pretty and structured