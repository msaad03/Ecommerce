<?php

    class shipper extends user
    {

        public static function signup()
        {
                $newShipper = new shipper();

                $newShipper->__set('name', $_POST['sh_name']);
                $newShipper->__set('address', $_POST['sh_addr']);
                $newShipper->__set('phone_no', $_POST['sh_phone']);
                $newShipper->__set('email', $_POST['sh_email']);
                $newShipper->__set('password', $_POST['sh_pass']);
                $newShipper->__set('reg_no', $_POST['sh_reg_no']);

                $name = $newShipper->__get('name');
                $add = $newShipper->__get('address');
                $email = $newShipper->__get('email');
                $phone = $newShipper->__get('phone_no');
                $original_pass = $newShipper->__get('password');
                $reg = $newShipper->__get('reg_no');

                $query2 = query("SELECT * FROM registration_number WHERE reg_no = '{$reg}'");
                confirm($query2);
                
                $query3 = query("SELECT * FROM shipper WHERE reg_no = '{$reg}'");
                confirm($query3);

            if(mysqli_num_rows($query2) < 1)
            {
                set_message("Registeration Number not Valid!!");
                redirect("signup.php");
            }
            else if(mysqli_num_rows($query3) > 0)
            {
                set_message("Shipper Already registered with this registration number..");
                redirect("signup.php");
            }

            else{


                $new_pass = md5($original_pass);

                query("INSERT INTO shipper(name, address, phone_no, reg_no, email, password) VALUES('$name', '$add', '$phone', '$reg', '$email', '$new_pass')");

                set_message("Shipper Signed up Successfully");

                $query1 = query("SELECT max(id) FROM shipper");
                confirm($query1);
                $row = fetch_array($query1);

                $_SESSION['name'] = $name;
                $_SESSION['u_id'] = $row['id'];
                $_SESSION['user'] = 2; 
                
                if(isset($_SESSION['direct_cart']))
                {
                    redirect("checkout.php");
                }
                else
                {
                    redirect("shipper_portal.php");
                }
            }
        }

        public static function login()
        {
                $email = escape_string($_POST['email']);
                $password = escape_string($_POST['password']);

                $password = md5($password);

                //$tablename = "shipper";

                $query = query("SELECT * FROM shipper WHERE email = '{$email}' AND password = '{$password}'");
                confirm($query);

                if(mysqli_num_rows($query) == 0)
                {
                    //set_message($password);
                    set_message("Invalid Email or Password");
                    redirect("login.php");
                }
                else
                {    
                    $q = query("SELECT name, id FROM shipper WHERE email = '{$email}' AND password = '{$password}'");
                    confirm($q);
                    $row = fetch_array($q);
                    
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['u_id'] = $row['id'];
                    $_SESSION['user'] = 2;

                    if(isset($_SESSION['direct_cart']))
                        redirect("checkout.php");
                    else
                        redirect("shipper_portal.php");
                }
        }

        public static function add_city()
        {

            $c_name = $_POST['c_name'];
            $s_charge = $_POST['s_charge'];
            
            $query2 = query("SELECT id FROM city WHERE name = '$c_name' ");
            confirm($query2);
            $city_id = fetch_array($query2);

            $shipper_id = $_SESSION['u_id'];

            query("INSERT INTO shipment_charges(shipper_id, city_id, charges) VALUES('$shipper_id','{$city_id['id']}','$s_charge')");
                        
            set_message("City Added Successfully");

            redirect("shipper_portal.php");
        }


        public static function view_my_cities()
        {

            $query1 = query("SELECT * FROM shipment_charges WHERE shipper_id = '{$_SESSION['u_id']}'");
            confirm($query1);
            
            while($row1 = fetch_array($query1))
            {

                $query2 = query("SELECT name FROM city WHERE id = '{$row1['city_id']}'");
                confirm($query2);
                $row2 = fetch_array($query2);
            
$city = <<<DELIMETER

<tr>
  <td>{$row2['name']}</td>
  <td>
    <a class='btn btn-warning' href="../resources/shipperValidate.php?deletecity={$row1['shipper_id']}"><span class='glyphicon glyphicon-remove'></span></a>
  <td>
</tr>

DELIMETER;

            echo $city;
                    }
        }

    public static function view_my_orders()
    {

        $query1 = query("SELECT * FROM orderr WHERE shipment_id IN (SELECT id FROM shipment_charges WHERE shipper_id = '{$_SESSION['u_id']}')");
        confirm($query1);
        
        while($row1 = fetch_array($query1))
        {
            $query2 = query("SELECT * FROM ordered_products WHERE order_id = '{$row1['id']}'");
            confirm($query2);
            $row2 = fetch_array($query2);

             if($row2['delivery_status'] == 1)
             {
                $query5 = query("SELECT charges FROM shipment_charges WHERE shipper_id = '{$_SESSION['u_id']}' AND  id = '{$row1['shipment_id']}'");
                confirm($query5);
                $row5 = fetch_array($query5);   

                $query4 = query("SELECT shop_id FROM stock WHERE product_id = '{$row2['product_id']}'");
                confirm($query4);
                $row4 = fetch_array($query4);       

                $query3 = query("SELECT c.name AS cName, c.address AS cAdd, s.name As sName FROM customer c, shop s WHERE c.id = '{$row1['cus_id']}' AND s.id = '{$row4['shop_id']}'");
                confirm($query3);
                $row3 = fetch_array($query3);

 $order = <<<DELIMETER

<tr>
  <td>{$row3['cName']}</td>
  <td>{$row3['cAdd']}</td>
  <td>{$row3['sName']}</td>
  <td>{$row2['product_id']}</td>
  <td>{$row5['charges']}</td>

  <td>
    <a class='btn btn-warning' href="../resources/shipperValidate.php?oid={$row1['id']}&pid={$row2['product_id']}">Deliver to Customer</a>
  <td>

 </tr>

DELIMETER;

 echo $order;
             }
         }
    }


    public static function collect_orders()
    {

        $query1 = query("SELECT * FROM orderr WHERE shipment_id IN (SELECT id FROM shipment_charges WHERE shipper_id = '{$_SESSION['u_id']}')");
        confirm($query1);
        
        while($row1 = fetch_array($query1))
        {
            $query2 = query("SELECT * FROM ordered_products WHERE order_id = '{$row1['id']}'");
            confirm($query2);

        while($row2 = fetch_array($query2))
        {    
             if($row2['delivery_status'] == 0)
             {
                $query4 = query("SELECT shop_id FROM stock WHERE product_id = '{$row2['product_id']}'");
                confirm($query4);
                $row4 = fetch_array($query4);       

                $query3 = query("SELECT name, address FROM shop WHERE id = '{$row4['shop_id']}'");
                confirm($query3);
                $row3 = fetch_array($query3);

 $order = <<<DELIMETER

<tr>
  <td>{$row3['name']}</td>
  <td>{$row3['address']}</td>
  <td>{$row2['product_id']}</td>
 </tr>

DELIMETER;

 echo $order;
             }
         }
    }
}


    public static function view_delivered_orders()
    {
        $query1 = query("SELECT * FROM orderr WHERE shipment_id IN (SELECT id FROM shipment_charges WHERE shipper_id = '{$_SESSION['u_id']}')");
        confirm($query1);
        
        while($row1 = fetch_array($query1))
        {
            $query2 = query("SELECT * FROM ordered_products WHERE order_id = '{$row1['id']}'");
            confirm($query2);
            $row2 = fetch_array($query2);

             if($row2['delivery_status'] == 2)
             {
                $query5 = query("SELECT charges FROM shipment_charges WHERE shipper_id = '{$_SESSION['u_id']}' AND  id = '{$row1['shipment_id']}'");
                confirm($query5);
                $row5 = fetch_array($query5);   

                $query4 = query("SELECT shop_id FROM stock WHERE product_id = '{$row2['product_id']}'");
                confirm($query4);
                $row4 = fetch_array($query4);       

                $query3 = query("SELECT c.name AS cName, c.address AS cAdd, s.name As sName FROM customer c, shop s WHERE c.id = '{$row1['cus_id']}' AND s.id = '{$row4['shop_id']}'");
                confirm($query3);
                $row3 = fetch_array($query3);

 $order = <<<DELIMETER

<tr>
  <td>{$row3['cName']}</td>
  <td>{$row3['cAdd']}</td>
  <td>{$row3['sName']}</td>
  <td>{$row2['product_id']}</td>
  <td>{$row5['charges']}</td>
 </tr>

DELIMETER;

 echo $order;
             }
         }
    }







    }

?>
