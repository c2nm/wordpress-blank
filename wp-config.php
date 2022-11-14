<?php
if( @$_SERVER['SERVER_ADMIN'] === '%MAIL_USER_1%' || @$_SERVER['NAME'] === '%ID_USER_1%' )
{
    define('DB_NAME', '%DB_NAME_1%');
    define('DB_USER', '%DB_USER_1%');
    define('DB_PASSWORD', '%DB_PASSWORD_1%');
    define('DB_HOST', '%DB_HOST_1%');
    define('WP_DEBUG', true);
    define('WP_DEBUG_LOG', false); // add true if you want to log to /wp-content/debug.log
    define('WP_DEBUG_DISPLAY', true);    
    define('DIEONDBERROR', true);
    define('DISABLE_WP_CRON', true); // disable wp-cron (only locally)
}
elseif( @$_SERVER['SERVER_ADMIN'] === '%MAIL_USER_2%' )
{
    define('DB_NAME', '%DB_NAME_2%');
    define('DB_USER', '%DB_USER_2%');
    define('DB_PASSWORD', '%DB_PASSWORD_2%');
    define('DB_HOST', '%DB_HOST_2%');
    define('WP_DEBUG', true);
    define('WP_DEBUG_LOG', false);
    define('WP_DEBUG_DISPLAY', true);    
    define('DIEONDBERROR', true);
    define('DISABLE_WP_CRON', true);
}
elseif( @$_SERVER['SERVER_ADMIN'] === '%MAIL_USER_3%' )
{
    define('DB_NAME', '%DB_NAME_3%');
    define('DB_USER', '%DB_USER_3%');
    define('DB_PASSWORD', '%DB_PASSWORD_3%');
    define('DB_HOST', '%DB_HOST_3%');
    define('WP_DEBUG', true);
    define('WP_DEBUG_LOG', false);
    define('WP_DEBUG_DISPLAY', true);    
    define('DIEONDBERROR', true);
    define('DISABLE_WP_CRON', true);
}
elseif( strpos(@$_SERVER['HTTP_HOST'], 'close2dev') !== false )
{
    define('DB_NAME', '%DB_NAME_TESTING%');
    define('DB_USER', '%DB_USER_TESTING%');
    define('DB_PASSWORD', '%DB_PASSWORD_TESTING%');
    define('DB_HOST', '%DB_HOST_TESTING%');
    define('WP_DEBUG', false);
    define('WP_DEBUG_LOG', false);
    define('WP_DEBUG_DISPLAY', false);
    define('DIEONDBERROR', false);
}
else
{
    define('DB_NAME', '%DB_NAME_PRODUCTION%');
    define('DB_USER', '%DB_USER_PRODUCTION%');
    define('DB_PASSWORD', '%DB_PASSWORD_PRODUCTION%');
    define('DB_HOST', 'localhost');
    define('WP_DEBUG', false);
    define('WP_DEBUG_LOG', false);
    define('WP_DEBUG_DISPLAY', false);
    define('DIEONDBERROR', false);
    // increase security on production and force httponly and secure on all php session cookies
    ini_set('session.cookie_httponly', 1);
    ini_set('session.cookie_secure', 1);
    // configure sentry.io php/js error monitoring plugin
    define( 'WP_SENTRY_PHP_DSN', 'https://********************************@********.ingest.sentry.io/*******' );
    define( 'WP_SENTRY_BROWSER_DSN', 'https://********************************@********.ingest.sentry.io/*******' );
    define( 'WP_SENTRY_ENV', str_replace('www.','',$_SERVER['HTTP_HOST']) );
    define( 'WP_SENTRY_ERROR_TYPES', E_ALL & ~E_WARNING & ~E_NOTICE ); // add this to hide warnings/notices
}

define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');

define( 'AUTH_KEY',         '{2[]zN,A!~JhcY4#$(=27i!@Xse{}A>x?8&@D6 ;WL[2Y0I52E9{5uz>;V1d CQN' );
define( 'SECURE_AUTH_KEY',  'Jq&[m0kle/zMlTB!9.qB4r;` j_D!)R[lB1S$@V6]7B.55#P%wl{YI.^e={oUO51' );
define( 'LOGGED_IN_KEY',    'Q/Mq&syc=*{r87`t4D(j*F}G?;[CI?.b3ml4n6b:agk&%u-?-EN5ZP:b!S>{Gya6' );
define( 'NONCE_KEY',        'F,vH RJ5^E7v:nO334VhZbF&,BM?dD7k-2}XNj_sPn[>6&tPjE%X:$]Uh&*%oEla' );
define( 'AUTH_SALT',        'WYUk[WH4*U2SwDs?^9D3|P]O,4/Kv(*2!P#uT;OIj@cIjl}m8@qKwy&]ac:F.Q~~' );
define( 'SECURE_AUTH_SALT', '$8BW;?J&7aTJP9MzX$chx>N>^M?L%7gawy 0pk`EQbku+x_`|Ebr@;Zzj8,O5DUK' );
define( 'LOGGED_IN_SALT',   '%-GkZ+&qlhP:ep/jiZ5Ur}gIZa~;,e16TvIH-2cDB=y# 6K-jsa7=`6]tlm8XqXV' );
define( 'NONCE_SALT',       'pruocuviToGr*dt`&G@TO&u`XsoA1F$FR>KW%vTLe7^LIuT8Zmm*[g7_/){Xy,r%' );

$table_prefix = 'custom_';

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

require_once ABSPATH . 'wp-settings.php';
