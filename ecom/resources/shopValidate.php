<?php require_once("config.php"); ?>

<?php 

if(isset($_GET['deleteproduct'])){
    query("DELETE FROM product WHERE id = " .escape_string($_GET['deleteproduct']). " ");
    set_message("Product Deleted");
    redirect("../public/shop_portal.php");
}

if(isset($_GET['oid']) && isset($_GET['pid'])){
	query("UPDATE ordered_products SET delivery_status = 1 WHERE order_id = " .escape_string($_GET['oid']). " AND product_id = " .escape_string($_GET['pid']). " ");
	set_message("Order Loaded");
    redirect("../public/shop_portal.php");
}


?>