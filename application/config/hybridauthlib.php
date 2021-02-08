<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*!
* HybridAuth
* http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
* (c) 2009-2012, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
*/

// ----------------------------------------------------------------------------------------
//	HybridAuth Config file: http://hybridauth.sourceforge.net/userguide/Configuration.html
// ----------------------------------------------------------------------------------------

$config =
    array(
        // set on "base_url" the relative url that point to HybridAuth Endpoint
        'base_url' => '/user/auth/user_login/endpoint',
        //  http://localhost/Codeigniter_social_api/index.php/hauth/endpoint?hauth.done=Facebook

        "providers" => array(
            // openid providers
            "OpenID" => array(
                "enabled" => FALSE
            ),

            "Yahoo" => array(
                "enabled" => FALSE,
                "keys" => array("id" => "", "secret" => ""),
            ),

            "AOL" => array(
                "enabled" => FALSE
            ),

            "Google" => array(
                "enabled" => true,
                "keys" => array("id" => "967920379151-lq3o54tv8pbl8au66j81v2qfv92usboq.apps.googleusercontent.com", "secret" => "hj3H0-x1624fGnTMyMZEh8pA"),
                "scope" => "https://www.googleapis.com/auth/userinfo.profile " . // optional
                           "https://www.googleapis.com/auth/userinfo.email", // optional
            ),

            "Facebook" => array(
                "enabled" => true,
                "keys" => array("id" => "161276087659951", "secret" => "f7f22b7b2ce8e467a35f1599ae5edd1c"),
                'scope' => 'email',
                'trustForwarded' => false

                //
                //
                //, user_about_me, user_birthday, user_hometown" , // optional
                //   "scope"   => "email, name, first_name, last_name, gender, picture," , // optional
            ),

            "Twitter" => array(
                "enabled" => true,
                "keys" => array("key" => "", "secret" => "")
            ),

            // windows live
            "Live" => array(
                "enabled" => FALSE,
                "keys" => array("id" => "", "secret" => "")
            ),

            "MySpace" => array(
                "enabled" => FALSE,
                "keys" => array("key" => "", "secret" => "")
            ),

            "LinkedIn" => array(
                "enabled" => true,
                "keys" => array("key" => "", "secret" => "")
            ),

            "Foursquare" => array(
                "enabled" => FALSE,
                "keys" => array("id" => "", "secret" => "")
            ),
        ),

        // if you want to enable logging, set 'debug_mode' to true  then provide a writable file by the web server on "debug_file"
        "debug_mode" => (ENVIRONMENT == 'development'),

        "debug_file" => APPPATH . '/logs/hybridauth.log',
    );


/* End of file hybridauthlib.php */
/* Location: ./application/config/hybridauthlib.php */