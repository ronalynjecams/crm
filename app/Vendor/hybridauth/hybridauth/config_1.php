<?php

/**
 * HybridAuth
 * http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
 * (c) 2009-2015, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
 */
// ----------------------------------------------------------------------------------------
//	HybridAuth Config file: http://hybridauth.sourceforge.net/userguide/Configuration.html
// ----------------------------------------------------------------------------------------

return
		array(
			"base_url" => "https://matching.blobby.xyz/",
			"providers" => array(
				// openid providers
				"OpenID" => array(
					"enabled" => true
				),
				"Yahoo" => array(
					"enabled" => true,
					"keys" => array("key" => "", "secret" => ""),
				),
				"AOL" => array(
					"enabled" => true
				),
				"Google" => array(
					"enabled" => true,
					"keys" => array("id" => "686150164209-sum0pqlf7ik235rgue89gqtr2glvkl19.apps.googleusercontent.com", "secret" => "XVUjoHGfLm6o9xDlzbzLGYp9"),
				),
				"Facebook" => array(
					"enabled" => true,
					"keys" => array("id" => "1122702134484996", "secret" => "7b0af04f37121605c43af48f12a41bbd"),
					"trustForwarded" => false
				),
				"Twitter" => array(
					"enabled" => true,
					"keys" => array("key" => "", "secret" => ""),
					"includeEmail" => false
				),
				// windows live
				"Live" => array(
					"enabled" => true,
					"keys" => array("id" => "", "secret" => "")
				),
				"LinkedIn" => array(
					"enabled" => true,
					"keys" => array("key" => "8104yeje7xucl4", "secret" => "gHmTMdZNLSSajrWL"),
					"fields" => array()
				),
				"Foursquare" => array(
					"enabled" => true,
					"keys" => array("id" => "", "secret" => "")
				),
			),
			// If you want to enable logging, set 'debug_mode' to true.
			// You can also set it to
			// - "error" To log only error messages. Useful in production
			// - "info" To log info and error messages (ignore debug messages)
			"debug_mode" => false,
			// Path to file writable by the web server. Required if 'debug_mode' is not false
			"debug_file" => "",
);
