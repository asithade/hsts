<?php
/*
Plugin Name: DS HSTS
Plugin URI: https://github.com/asithade/hsts
Description: Adds HTTP Strict Transport Security to wordpress
Author: Asitha de Silva
Version: 1.0
Author URI: http://asithadesilva.com
Contributors: shawfactor
*/

if (!class_exists('DS_HSTS_Plugin')) {

	class DS_HSTS_Plugin {
		private $max_age;
		private $subdomain; 
		private $preload;
		private $redirect;
		private $uri;
		private $domain;
		private $current_domain;

		function __construct() {
			$this->uri = $_SERVER['REQUEST_URI'];
			$this->domain = $_SERVER['HTTP_HOST'];
			$this->current_domain = get_site_url();
			add_action( 'admin_init', array($this, 'hsts_register_settings'));
			add_action( 'admin_menu', array($this, 'hsts_register_options_page'));
			add_action( 'send_headers', array($this, "add_header"));
		}

		public function add_header(){
			if($this->current_domain == "http://". $this->domain || $this->current_domain == "https://". $this->domain){
				if (isset($_SERVER['HTTPS'])){
					$this->subdomain = get_option('hsts-include-subdomain');
					$this->preload = get_option('hsts-include-preload');
					$this->redirect = get_option('hsts-include-redirect');
					$this->max_age = get_option('hsts-max-age');

					$string = "max-age=".$this->max_age.";";
					if($this->subdomain == "yes"){ 
						$string .= " includeSubDomains;";
					}
					if($this->preload == "yes"){ 
						$string .= " preload"; 
					}

					header("Strict-Transport-Security: ". $string);
				} else {
					if ($this->redirect == "yes"){ 
						header('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], true, 301);
					}
				}
			} else {
				Header( "HTTP/1.1 301 Moved Permanently" );
				Header( "Location: ". $this->current_domain . $this->uri );
				die();
			}
		}

		public function hsts_register_options_page() {
			add_options_page('HSTS', 'HSTS', 'manage_options', 'hsts', array($this, 'DS_hsts_plugin_options_page'));
		}

		public function hsts_register_settings() {
		   add_option( 'hsts-include-subdomain', 'no');
		   add_option( 'hsts-include-preload', 'yes');
		   add_option( 'hsts-include-redirect', '');
		   add_option( 'hsts-max-age', '15984000');
		   register_setting( 'hsts_option_group', 'hsts-include-subdomain', 'hsts-callback' );
		   register_setting( 'hsts_option_group', 'hsts-include-preload', 'hsts-callback' );
		   register_setting( 'hsts_option_group', 'hsts-include-redirect', 'hsts-callback' );
		   register_setting( 'hsts_option_group', 'hsts-max-age', 'hsts-callback' );
		}

		public function DS_hsts_plugin_options_page() {
			$subdomain = get_option('hsts-include-subdomain');
			$preload = get_option('hsts-include-preload');
			$redirect = get_option('hsts-include-redirect');
			$max_age = get_option('hsts-max-age');
			$subdomain_checked = ($subdomain == "yes") ? 'checked="checked"' : 'no';
			$preload_checked = ($preload == "yes") ? 'checked="checked"' : 'no';
			$redirect_checked = ($redirect == "yes") ? 'checked="checked"' : 'no';
			?>
			<div>
			<h2>HSTS Plugin Options</h2>
				<form method="post" action="options.php">
					<?php settings_fields( 'hsts_option_group' ); ?>
					<table>
						<tr valign="top">
							<td><label for="hsts-include-subdomain"><input type="checkbox" id="hsts-include-subdomain" name="hsts-include-subdomain" value="yes" <?php echo $subdomain_checked; ?>> Include subdomain</label></td>
						</tr>
						<tr valign="top">
							<td><label for="hsts-include-preload"><input type="checkbox" id="hsts-include-preload" name="hsts-include-preload" value="yes" <?php echo $preload_checked; ?>> Include preload</label></td>
						</tr>
						<tr valign="top">
							<td><label for="hsts-include-redirect"><input type="checkbox" id="hsts-include-redirect" name="hsts-include-redirect" value="yes" <?php echo $redirect_checked; ?>> Include redirect</label></td>
						</tr>
						<tr valign="top">
							<td>Max Age: <input type="text" id="hsts-max-age" name="hsts-max-age" value="<?php echo $max_age; ?>"></td>
						</tr>
					</table>
					<?php submit_button(); ?>
				</form>
			</div>
			<?php
		}
	}

	$HSTS = new DS_HSTS_Plugin();
}