<?php

    class shop extends user
    {

        public static function signup()
        {
                $newShop = new shop();

                $newShop->__set('name', $_POST['shop_name']);
                $newShop->__set('address', $_POST['shop_addr']);
                $newShop->__set('phone_no', $_POST['shop_phone']);
                $newShop->__set('email', $_POST['shop_email']);
                $newShop->__set('password', $_POST['shop_pass']);
                $newShop->__set('reg_no', $_POST['shop_reg_no']);

                $name = $newShop->__get('name');
                $add = $newShop->__get('address');
                $email = $newShop->__get('email');
                $phone = $newShop->__get('phone_no');
                $original_pass = $newShop->__get('password');
                $reg = $newShop->__get('reg_no');

                $query2 = query("SELECT * FROM registration_number WHERE reg_no = '{$reg}'");
                confirm($query2);
                
                $query3 = query("SELECT * FROM shop WHERE reg_no = '{$reg}'");
                confirm($query3);

            if(mysqli_num_rows($query2) < 1)
            {
                set_message("Registeration Number not Valid!!");
                redirect("signup.php");
            }
            else if(mysqli_num_rows($query3) > 0)
            {
                set_message("Shop Already registered with this registration number..");
                redirect("signup.php");
            }

            else{

                $new_pass = md5($original_pass);

                query("INSERT INTO shop(name, address, phone_no, reg_no, email, password) VALUES('$name', '$add', '$phone', '$reg', '$email', '$new_pass')");

                set_message("Shop Signed up Successfully");

                $query1 = query("SELECT max(id) FROM shop");
                confirm($query1);
                $row = fetch_array($query1);

                $_SESSION['name'] = $name;
                $_SESSION['u_id'] = $row['id'];
                $_SESSION['user'] = 3; 
                
                if(isset($_SESSION['direct_cart']))
                {
                    redirect("checkout.php");
                }
                else
                {
                    redirect("shop_portal.php");
                }
            }
        }

        public static function login()
        {
                $email = escape_string($_POST['email']);
                $password = escape_string($_POST['password']);

                //$password = md5($password);

                //$tablename = "shop";

                $query = query("SELECT * FROM shop WHERE email = '{$email}' AND password = '{$password}'");
                confirm($query);

                if(mysqli_num_rows($query) == 0)
                {
                    //set_message($password);
                    set_message("Invalid Email or Password");
                    redirect("login.php");
                }
                else
                {    
                    $q = query("SELECT name, id FROM shop WHERE email = '{$email}' AND password = '{$password}'");
                    confirm($q);
                    $row = fetch_array($q);
                    
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['u_id'] = $row['id'];
                    $_SESSION['user'] = 3;

                    if(isset($_SESSION['direct_cart']))
                        redirect("checkout.php");
                    else
                        redirect("shop_portal.php");
                }
        }


    public static function add_product()
    {
        $newProduct = new product();

        $cat_query = query("SELECT id FROM category WHERE name = '{$_POST['p_cat']}'");
        confirm($cat_query);
        $p_cid = fetch_array($cat_query);
        $p_cat_id = $p_cid['id'];
        $brand_query = query("SELECT id FROM brand WHERE name = '{$_POST['p_brand']}'");
        confirm($brand_query);
        $p_bid = fetch_array($brand_query);
        $p_brand_id = $p_bid['id'];

        $newProduct->__set('name', $_POST['p_name']);
        $newProduct->__set('price', $_POST['p_price']);
        $newProduct->__set('size', $_POST['p_size']);
        $newProduct->__set('description', $_POST['description']);
        $newProduct->__set('category_id', $p_cat_id);
        $newProduct->__set('brand_id', $p_brand_id);

        $p_name = $newProduct->__get('name');
        $p_price = $newProduct->__get('price');
        $p_size = $newProduct->__get('size');
        $p_desc = $newProduct->__get('description');
        $p_c_id = $newProduct->__get('category_id');;
        $p_b_id = $newProduct->__get('brand_id');

        if($_POST['p_quantity'] > 0){
            $p_quantity = $_POST['p_quantity'];
        }
        else{
            set_message("Quantity must be greater than 0");
            redirect("shop_portal.php");
        }

        $file = $_FILES['file'];

        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];
        $fileDestination = "";
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png');

        if(in_array($fileActualExt, $allowed)){

            if($fileError === 0){

                if($fileSize < 1000000){

                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                    $fileDestination = '../public/product_images/'.$fileNameNew;

                    $newProduct->__set('image', $fileDestination);
                    $p_image = $newProduct->__get('image');

                    move_uploaded_file($fileTmpName, $p_image);

                    $insert_product = query("INSERT INTO product(name, category_id, price, brand_id, image, size, description) VALUES('$p_name','$p_c_id','$p_price','$p_b_id','$p_image','$p_size','$p_desc')");

                    $pId_query = query("SELECT max(id) AS newId FROM product");
                    confirm($pId_query);
                    $new_product_id = fetch_array($pId_query);

                    $shop_id = (int)$_SESSION['u_id'];

                    query("INSERT INTO stock(shop_id, product_id, quantity) VALUES('$shop_id','{$new_product_id['newId']}','$p_quantity')");
                    
                    set_message("Product Added Successfully");

                    redirect("shop_portal.php");

                }else{
                    set_message("File size is too big.");
                }

            }else{
                set_message("There was an error uploading your file.");
            }

        }else{
            set_message("File type not allowed.");
        }
    }


    public static function view_my_products()
    {

        $query1 = query("SELECT s.product_id AS pId, s.quantity AS pQ, p.name AS pN, p.price AS pP FROM stock s, product p WHERE s.product_id = p.id AND s.shop_id = '{$_SESSION['u_id']}'");
        confirm($query1);
        
        while($row1 = fetch_array($query1))
        {

$product = <<<DELIMETER

<tr>
  <td>{$row1['pId']}</td>
  <td>{$row1['pN']}</td>
  <td>{$row1['pQ']}</td>
  <td>{$row1['pP']}</td>
  <td>
    <a class='btn btn-warning' href="../resources/shopValidate.php?deleteproduct={$row1['pId']}"><span class='glyphicon glyphicon-remove'></span></a>
  <td>
</tr>

DELIMETER;

echo $product;
        }
    }

    public static function view_my_orders()
    {

        $query1 = query("SELECT * FROM ordered_products WHERE product_id IN (SELECT product_id FROM stock WHERE shop_id = '{$_SESSION['u_id']}')");
        confirm($query1);
        
        while($row1 = fetch_array($query1))
        {
            //$query3 = query("SELECT delivery_status AS status FROM order WHERE id = '{$row1['order_id']}'");
            //confirm($query3);
            //$row3 = fetch_array($query3);

            if($row1['delivery_status'] == 0)
            {
                $query2 = query("SELECT c.name AS cName, s.name As sName FROM customer c, shipper s WHERE c.id = (SELECT cus_id FROM orderr WHERE id = '{$row1['order_id']}') AND s.id = (SELECT shipper_id FROM shipment_charges WHERE id = (SELECT shipment_id FROM orderr WHERE id = '{$row1['order_id']}'))");
                confirm($query2);
                

                while($row2 = fetch_array($query2))
                {

                $query3 = query("SELECT price FROM product WHERE id = '{$row1['product_id']}'");
                confirm($query3);
                $row3 = fetch_array($query3);

                $product_total = $row1['quantity'] * $row3['price'];

$product = <<<DELIMETER

<tr>
  <td>{$row2['cName']}</td>
  <td>{$row2['sName']}</td>
  <td>{$row1['product_id']}</td>
  <td>{$row1['quantity']}</td>
  <td>{$product_total}</td>
  <td>
    <a class='btn btn-warning' href="../resources/shopValidate.php?oid={$row1['order_id']}&pid={$row1['product_id']}">Load to Shipper</a>
  <td>
</tr>

DELIMETER;

echo $product;

                }

            }
        }
    }

public static function view_completed_orders()
    {
        $query1 = query("SELECT * FROM ordered_products WHERE product_id IN (SELECT product_id FROM stock WHERE shop_id = '{$_SESSION['u_id']}')");
        confirm($query1);
        
        while($row1 = fetch_array($query1))
        {
            // $query3 = query("SELECT delivery_status AS status FROM orderr WHERE id = '{$row1['order_id']}'");
            // confirm($query3);
            // $row3 = fetch_array($query3);

            if($row1['delivery_status'] == 1)
            {
                $query2 = query("SELECT c.name AS cName, s.name As sName FROM customer c, shipper s WHERE c.id = (SELECT cus_id FROM orderr WHERE id = '{$row1['order_id']}') AND s.id = (SELECT shipper_id FROM shipment_charges WHERE id = (SELECT shipment_id FROM orderr WHERE id = '{$row1['order_id']}'))");
                confirm($query2);
                $row2 = fetch_array($query2);

                $query3 = query("SELECT price FROM product WHERE id = '{$row1['product_id']}'");
                confirm($query3);
                $row3 = fetch_array($query3);

                $product_total = $row1['quantity'] * $row3['price'];

$product = <<<DELIMETER

<tr>
  <td>{$row2['cName']}</td>
  <td>{$row2['sName']}</td>
  <td>{$row1['product_id']}</td>
  <td>{$row1['quantity']}</td>
  <td>$product_total</td>
</tr>

DELIMETER;

echo $product;
            }
        }
    }






    }

?>