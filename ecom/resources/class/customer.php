<?php

    class customer extends user
    {

        public static function signup()
        {

             	$newCustomer = new customer();

                $newCustomer->__set('name', $_POST['cus_name']);
                $newCustomer->__set('address', $_POST['cus_addr']);
                $newCustomer->__set('phone_no', $_POST['cus_phone']);
                $newCustomer->__set('email', $_POST['cus_email']);
                $newCustomer->__set('password', $_POST['cus_pass']);

                $name = $newCustomer->__get('name');
                $add = $newCustomer->__get('address');
                $email = $newCustomer->__get('email');
                $phone = $newCustomer->__get('phone_no');
                $original_pass = $newCustomer->__get('password');

                // $sel_query = query("SELECT max(id) AS newId from customers;");
                // confirm($sel_query);
                // $row1 = fetch_array($sel_query);

                //$new_pass = md5($original_pass);

                query("INSERT INTO customer(name, address, email, phone, password) VALUES('$name','$add','$email','$phone','$new_pass')");

                set_message("Customer Signed up Successfully");

                $query1 = query("SELECT max(id) FROM customer");
                confirm($query1);
                $row = fetch_array($query1);

                $_SESSION['name'] = $name;
                $_SESSION['u_id'] = $row['id'];
                $_SESSION['user'] = 1;

                if(isset($_SESSION['direct_cart']))
                {
                    redirect("checkout.php");
                }
                else
                {
                    redirect("customer_portal.php");
                }

        }

        public static function login()
        {
                $email = escape_string($_POST['email']);
                $password = escape_string($_POST['password']);

                //$password = md5($password);


                //$tablename = "customer";

                $query = query("SELECT * FROM customer WHERE email = '{$email}' AND password = '{$password}'");
                confirm($query);

                if(mysqli_num_rows($query) == 0)
                {
                    //set_message($password);
                    set_message("Invalid Email or Password");
                    redirect("login.php");
                }
                else
                {    
                    $q = query("SELECT name, id FROM customer WHERE email = '{$email}' AND password = '{$password}'");
                    confirm($q);
                    $row = fetch_array($q);
                    
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['u_id'] = $row['id'];
           	        $_SESSION['user'] = 1;

                    if(isset($_SESSION['direct_cart']))
                        redirect("checkout.php");
                    else
                        redirect("customer_portal.php");
                }
        } 


 public static function pending_orders()
    {

        $query1 = query("SELECT * FROM orderr WHERE cus_id = '{$_SESSION['u_id']}'");
        confirm($query1);
        
        while($row1 = fetch_array($query1))
        {

            $query2 = query("SELECT shipper_id FROM shipment_charges WHERE id = '{$row1['shipment_id']}'");
            confirm($query2);
            $row2 = fetch_array($query2);

            $query3 = query("SELECT name FROM shipper WHERE id = '{$row2['shipper_id']}'");
            confirm($query3);
            $row3 = fetch_array($query3);

            $query4 = query("SELECT * FROM ordered_products WHERE order_id = '{$row1['id']}'");
            confirm($query4);
            //$row7 = fetch_array($query4);


            while($row4 = fetch_array($query4))
            {

                if($row4['delivery_status'] < 2)
                {
                    $query5 = query("SELECT name FROM product WHERE id = '{$row4['product_id']}'");
                    confirm($query5);
                    $row5 = fetch_array($query5);   

                    $query6 = query("SELECT name FROM shop WHERE id IN (SELECT s.shop_id from stock s, ordered_products o where s.product_id = o.product_id AND o.order_id = '{$row1['id']}') ");
                    confirm($query6);
                    $row6 = fetch_array($query6);   
                    
$order = <<<DELIMETER
<tr>
   
  <td>{$row5['name']}</td> 
  <td>{$row4['quantity']}</td>  
  <td>{$row6['name']}</td> 
  <td>{$row3['name']}</td> 
  <td>{$row1['total_bill']}</td>

</tr>

DELIMETER;

echo $order;
         }
            }

         }
    }



     public static function completed_orders()
     {

$query1 = query("SELECT * FROM orderr WHERE cus_id = '{$_SESSION['u_id']}'");
        confirm($query1);
        
        while($row1 = fetch_array($query1))
        {

            $query2 = query("SELECT shipper_id FROM shipment_charges WHERE id = '{$row1['shipment_id']}'");
            confirm($query2);
            $row2 = fetch_array($query2);

            $query3 = query("SELECT name FROM shipper WHERE id = '{$row2['shipper_id']}'");
            confirm($query3);
            $row3 = fetch_array($query3);

            $query4 = query("SELECT * FROM ordered_products WHERE order_id = '{$row1['id']}'");
            confirm($query4);
            



            while($row4 = fetch_array($query4))
            {
                if($row4['delivery_status'] == 2)
                {   

                    $query5 = query("SELECT name FROM product WHERE id = '{$row4['product_id']}'");
                    confirm($query5);
                    $row5 = fetch_array($query5);   

                    $query6 = query("SELECT name FROM shop WHERE id IN (SELECT s.shop_id from stock s, ordered_products o where s.product_id = o.product_id AND o.order_id = '{$row1['id']}') ");
                    confirm($query6);
                    $row6 = fetch_array($query6);   
                
$order = <<<DELIMETER
<tr>
   
  <td>{$row5['name']}</td> 
  <td>{$row4['quantity']}</td>  
  <td>{$row6['name']}</td>  
  <td>{$row3['name']}</td>
  <td>{$row1['total_bill']}</td>

</tr>

DELIMETER;

echo $order;

            }
        }
    }

}










    }

?>