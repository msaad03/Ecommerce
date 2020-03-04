<?php require_once("config.php"); ?>

<?php 

	if(isset($_GET['deletecity'])){
	    query("DELETE FROM city WHERE id = " .escape_string($_GET['deletecity']). " ");
	    set_message("City Deleted");
	    redirect("../public/shipper_portal.php");
	}

	if(isset($_GET['oid']) && isset($_GET['pid'])){
		query("UPDATE ordered_products SET delivery_status = 2 WHERE order_id = " .escape_string($_GET['oid']). " AND product_id = " .escape_string($_GET['pid']). " ");
		
		
		$del_date = date("Y-m-d");
    	//$del_time = date("h:i:sa");
		
		mailtocustomer("Notification for Delivery received", "Congrats! You have received your delivery at " . $del_date);


		query("UPDATE orderr SET delivery_date = $del_date WHERE id = " .escape_string($_GET['oid']). " ");


		set_message("Order Delivered");
	    redirect("../public/shipper_portal.php");
	}


?>