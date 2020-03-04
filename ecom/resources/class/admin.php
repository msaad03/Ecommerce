<?php

	/**
	 * 
	 */
	class admin extends user
	{
		
		public static function login()
        {
                $email = escape_string($_POST['email']);
                $password = escape_string($_POST['password']);

                //$tablename = "shop";

                $query = query("SELECT * FROM admin WHERE email = '{$email}' AND password = '{$password}'");
                confirm($query);

                if(mysqli_num_rows($query) == 0)
                {
                    set_message("Invalid Email or Password");
                    redirect("admin_login.php");
                }
                else
                {    
                    $q = query("SELECT name, id FROM admin WHERE email = '{$email}' AND password = '{$password}'");
                    confirm($q);
                    $row = fetch_array($q);
                    
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['u_id'] = $row['id'];
                    $_SESSION['user'] = 4;

                    redirect("admin/index.php");

                }
        }

        public static function view_all_orders()
        {
        	$query = query("SELECT * FROM orderr");
            confirm($query);
            

            while($row = fetch_array($query))
            {

            	$query1 = query("SELECT name FROM customer where id = '{$row['cus_id']}'");
            	confirm($query1);
				$row1 = fetch_array($query1);

$order = <<<DELIMETER

<tr>
  <td>{$row['id']}</td>
  <td>{$row1['name']}</td>
  <td>{$row['ordering_address']}</td>
  <td>{$row['date']}</td>
  <td>{$row['time']}</td>
</tr>

DELIMETER;

echo $order;

            }
        }


        public static function addCat()
        {
        	$catName = $_POST['catName'];

        	query("INSERT INTO category(name) VALUES('$catName')");

        	set_message("Category Added!");
            redirect("index.php");

        }

public static function view_all_category()
        {
            $query = query("SELECT * FROM category");
            confirm($query);
            
            while($row = fetch_array($query))
            {
            

$cat = <<<DELIMETER

<tr>
  <td>{$row['id']}</td>
  <td>{$row['name']}</td>
</tr>

DELIMETER;

echo $cat;

            }
        }
        public static function addAd()
        {
            $adName = $_POST['adName'];
            $adlink = $_POST['adLink'];

             $file = $_FILES['file'];

        // $fileName = $_FILES['file2']['name'];
        // $fileTmpName = $_FILES['file2']['tmp_name'];
        // $fileSize = $_FILES['file2']['size'];
        // $fileError = $_FILES['file2']['error'];
        // $fileType = $_FILES['file2']['type'];
        // $fileDestination = "";
        // $fileExt = explode('.', $fileName);
        // $fileActualExt =  strtolower(end($fileExt));

        // $allowed = array('jpg', 'jpeg', 'png');

        // if(in_array($fileActualExt, $allowed)){

        //     if($fileError === 0){

        //         if($fileSize < 1000000){

        //             $fileNameNew = uniqid('', true).".".$fileActualExt;
        //             $fileDestination = '../public/ad_images/'.$fileNameNew;

        //             //$newProduct->__set('image', $fileDestination);
        //             $p_image = $fileDestination;

        //             move_uploaded_file($fileTmpName, $p_image);

        //             $insert_product = query("INSERT INTO ads(name, link, image) VALUES('$adName','$adLink','$p_image')");
                  
                    
        //             set_message("Ad Added Successfully");

        //             redirect("index.php");

        //         }else{
        //             set_message("File size is too big.");
        //         }

        //     }else{
        //         set_message("There was an error uploading your file.");
        //     }

        // }else{
        //     set_message("File type not allowed.");
        // }

    }



	}

?>	