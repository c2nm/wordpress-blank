<?php
if( $_SERVER['SERVER_ADMIN'] == 'david@close2.de' )
{
    define('DB_NAME', 'xxxxxxxx');
    define('DB_USER', 'xxxxxxxx');
    define('DB_PASSWORD', 'xxxxxxxx');
    define('DB_HOST', 'localhost');
}
elseif( strpos($_SERVER['HTTP_HOST'], 'close2dev') !== false )
{
    define('DB_NAME', 'xxxxxxxx');
    define('DB_USER', 'xxxxxxxx');
    define('DB_PASSWORD', 'xxxxxxxx');
    define('DB_HOST', 'localhost');
}
else
{
    define('DB_NAME', 'xxxxxxxx');
    define('DB_USER', 'xxxxxxxx');
    define('DB_PASSWORD', 'xxxxxxxx');
    define('DB_HOST', 'localhost');
}

define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');
define('WP_DEBUG', false);
define('DIEONDBERROR', true);

define( 'AUTH_KEY',         '{2[]zN,A!~JhcY4#$(=27i!@Xse{}A>x?8&@D6 ;WL[2Y0I52E9{5uz>;V1d CQN' );
define( 'SECURE_AUTH_KEY',  'Jq&[m0kle/zMlTB!9.qB4r;` j_D!)R[lB1S$@V6]7B.55#P%wl{YI.^e={oUO51' );
define( 'LOGGED_IN_KEY',    'Q/Mq&syc=*{r87`t4D(j*F}G?;[CI?.b3ml4n6b:agk&%u-?-EN5ZP:b!S>{Gya6' );
define( 'NONCE_KEY',        'F,vH RJ5^E7v:nO334VhZbF&,BM?dD7k-2}XNj_sPn[>6&tPjE%X:$]Uh&*%oEla' );
define( 'AUTH_SALT',        'WYUk[WH4*U2SwDs?^9D3|P]O,4/Kv(*2!P#uT;OIj@cIjl}m8@qKwy&]ac:F.Q~~' );
define( 'SECURE_AUTH_SALT', '$8BW;?J&7aTJP9MzX$chx>N>^M?L%7gawy 0pk`EQbku+x_`|Ebr@;Zzj8,O5DUK' );
define( 'LOGGED_IN_SALT',   '%-GkZ+&qlhP:ep/jiZ5Ur}gIZa~;,e16TvIH-2cDB=y# 6K-jsa7=`6]tlm8XqXV' );
define( 'NONCE_SALT',       'pruocuviToGr*dt`&G@TO&u`XsoA1F$FR>KW%vTLe7^LIuT8Zmm*[g7_/){Xy,r%' );

$table_prefix = 'custom_';

define( 'WP_DEBUG', false );

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

require_once( ABSPATH . 'wp-settings.php' );
