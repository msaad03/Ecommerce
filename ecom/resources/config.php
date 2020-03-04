<?php

ob_start();

session_start();
//session_destroy();

// set timeout period in seconds
$inactive = 500;
// check to see if $_SESSION['timeout'] is set
if(isset($_SESSION['timeout']) && isset($_SESSION['u_id']) ) {
	$session_life = time() - $_SESSION['timeout'];
	if($session_life > $inactive)
        { session_destroy(); header("Location: logout.php"); }
}
$_SESSION['timeout'] = time();


defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);

defined("TEMPLATE_FRONT") ? null : define("TEMPLATE_FRONT", __DIR__ . DS . "templates\\front");

defined("TEMPLATE_BACK") ? null : define("TEMPLATE_BACK", __DIR__ . DS . "templates\back");


defined("DB_HOST") ? null : define("DB_HOST", "localhost");

defined("DB_USER") ? null : define("DB_USER", "root");

defined("DB_PASS") ? null : define("DB_PASS", "");

defined("DB_NAME") ? null : define("DB_NAME", "ecommerce");

$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);


require_once("class/user.php");
require_once("class/customer.php");
require_once("class/shipper.php");
require_once("class/shop.php");
require_once("class/product.php");
require_once("class/admin.php");

require_once("functions.php");
require_once("cartValidate.php");


?>