<?php

//helper functions

    function set_message($msg){
        if(!empty($msg)){
            $_SESSION['message'] = $msg;
        }
        else{
            $msg = "";
        }
    }

    function display_message(){
        if(isset($_SESSION['message'])){
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
    }


    function redirect($location){
        header("Location: $location");
    }
    function query($sql){
        global $connection;
        return mysqli_query($connection, $sql);
    }
    function confirm($result){
        if(!$result){
            die("QUERY FAILED" . mysqli_error($connection));
        }
    }
    function escape_string($string){
        global $connection;
        return mysqli_real_escape_string($connection, $string);
    }
    function fetch_array($result){
        return mysqli_fetch_array($result);
    }



/*****************FRONT END FUNCTIONS*********************/


//get products

function get_products(){

$query = query("SELECT p.id, p.name, p.price, p.image, b.name AS bname FROM product p, brand b WHERE p.brand_id = b.id");
confirm($query);

while($row = fetch_array($query)){
$product = <<<DELIMETER
<div class="col-sm-4 col-lg-4 col-md-4">
    <div class="thumbnail">
        <a href="item.php?id={$row['id']}" class="t_size"><img src="{$row['image']}" alt="{$row['name']}"></a>
        <div class="caption">
            <h4 class="pull-right">&#36;{$row['price']}</h4>
            <h4><a href="item.php?id={$row['id']}">{$row['name']}</a></h4>
            <a class="btn btn-danger" href="../resources/cartValidate.php?add={$row['id']}">Add to Cart</a>
            <h5 class="pull-right">{$row['bname']}</h5>
        </div>
    </div>
</div>

DELIMETER;

echo $product;
}
}

//get categories

function get_categories(){

$query = query("SELECT * FROM category");
confirm($query);

while($row = fetch_array($query)){
$categories_links = <<<DELIMETER
<a href='category.php?id={$row['id']}' class='list-group-item'>{$row['name']}</a>
DELIMETER;

echo $categories_links;

}
}


//get brands

function get_brands(){

$query = query("SELECT * FROM brand");
confirm($query);

while($row = fetch_array($query)){
$brands_links = <<<DELIMETER
<a href='brand.php?id={$row['id']}' class='list-group-item'>{$row['name']}</a>
DELIMETER;

echo $brands_links;


}
}


function get_ad(){

$query = query("SELECT * FROM ads");
confirm($query);

while($row = fetch_array($query)){
$categories_links = <<<DELIMETER
<div><a href='index.php' class='list-group-item'>
    <img style="width:230px; height:400px" src='{$row['image']}'>
    </a></div>
DELIMETER;

echo $categories_links;

    }
}

//get products in category page

function get_products_in_cat_page(){

$query = query("SELECT * FROM product WHERE category_id = " .escape_string($_GET['id']). " ");
confirm($query);

//$row = fetch_array($query);

$query2 = query("SELECT name FROM category WHERE id = " .escape_string($_GET['id']). " ");
confirm($query2);
$catName = fetch_array($query2);
echo "<h1>{$catName['name']}</h1>
            <hr>";

while($row = fetch_array($query)){
$product = <<<DELIMETER
            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <a href="item.php?id={$row['id']}" class="t_size"><img src="{$row['image']}" alt="{$row['name']}"></a>
                    <div class="caption">
                        <h3>{$row['name']}</h3>
                        <p>
                            <a href="../resources/cartValidate.php?add={$row['id']}" class="btn btn-primary">Buy Now!</a>
                            <a href="item.php?id={$row['id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>


DELIMETER;

echo $product;
}
}


//get products in brand page

function get_products_in_brand_page(){

$query = query("SELECT * FROM product WHERE brand_id = " .escape_string($_GET['id']). " ");
confirm($query);

$query2 = query("SELECT name FROM brand WHERE id = " .escape_string($_GET['id']). " ");
confirm($query2);

$brandName = fetch_array($query2);
echo "<h1>{$brandName['name']}</h1>
            <hr>";

while($row = fetch_array($query)){
$product = <<<DELIMETER
            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <a href="item.php?id={$row['id']}" class="t_size"><img src="{$row['image']}" alt="{$row['name']}"></a>
                    <div class="caption">
                        <h3>{$row['name']}</h3>
                        <p>
                            <a href="../resources/cartValidate.php?add={$row['id']}" class="btn btn-primary">Buy Now!</a>
                            <a href="item.php?id={$row['id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>


DELIMETER;

echo $product;
}
}

function send_message(){
    if(isset($_POST['submit'])){
        $to         = "abc@gmail.com";
        $from       = $_POST['name'];
        $subject    = $_POST['subject'];
        $email      = $_POST['email'];
        $message    = $_POST['message'];

        $headers = "From: {$from} {$email}";

        $result = mail($to, $subject, $message, $headers);
        if(!$result){
            set_message("Message Not Send");
            redirect("contact.php");
        }
        else{
            set_message("Message Send");
            redirect("contact.php");
        }
    }
}


/*****************BACK END FUNCTIONS*********************/


/**** ADD PRODUCTS ****/

function get_category_options(){

    $query = query("SELECT name FROM category");
    confirm($query);

    while($row = fetch_array($query)){
        echo "<option>" . $row['name'] . "</option>";
        
    }
}

function get_brand_options(){

    $query = query("SELECT name FROM brand");
    confirm($query);

    while($row = fetch_array($query)){
        echo "<option>" . $row['name'] . "</option>";
        
    }
}



function get_my_products(){

$product = <<<DELIMETER

<tr>
  <td>{$row['name']}</td>
  <td>&#36;{$row['price']}</td>
  <td>{$value}</td>
  <td>&#36;{$sub}</td>
  <td>
    <a class='btn btn-warning' href="../resources/cartValidate.php?remove={$row['id']}"><span class='glyphicon glyphicon-minus'></span></a>
    <a class='btn btn-success' href="../resources/cartValidate.php?add={$row['id']}"><span class='glyphicon glyphicon-plus'></span></a>
    <a class='btn btn-danger' href="../resources/cartValidate.php?delete={$row['id']}"><span class='glyphicon glyphicon-remove'></span></a>
  </td>
</tr>

DELIMETER;


echo $product;


}


function get_shippers(){

    $query2 = query("SELECT * FROM shipment_charges WHERE city_id =(SELECT id FROM city WHERE name = '{$_SESSION['city_name']}') ");
    confirm($query2); 

    while($row2 = fetch_array($query2))
    {
        $query = query("SELECT name FROM shipper WHERE id = '{$row2['shipper_id']}' ");
        confirm($query);

        $row = fetch_array($query);
        echo "<option value = " . $row2['id'] . " >" . $row['name'] . " --- $" . $row2['charges'] . "</option>";
    }    
   
}


function get_city(){

    $query = query("SELECT distinct(name) FROM city");
    confirm($query);

    while($row = fetch_array($query)){
        echo "<option>" . $row['name'] . "</option>";
        
    }
}


function set_add(){
    $_SESSION['city_name'] = $_POST['city_name'];
    $_SESSION['ship_add'] = $_POST['ship_add'];
    redirect("checkout.php");
}



function search_product()
{

        $search_text = $_POST['search'];

        $query = query("SELECT id FROM product WHERE name LIKE '%$search_text%' ");
        confirm($query);

        $row = fetch_array($query);

        redirect("../public/item.php?id={$row['id']}");

}


function submit_review(){

    $review = $_POST['review'];
    $cus_id = $_SESSION['u_id'];
    $product_id = $_GET['id'];

    query("INSERT INTO customer_reviews(cus_id, product_id, review) VALUES('$cus_id', '$product_id', '$review')");

    redirect("item.php?id={$product_id}");


}


require 'authorize/vendor/autoload.php';
  require_once 'authorize/constants/SampleCodeConstants.php';
  use net\authorize\api\contract\v1 as AnetAPI;
  use net\authorize\api\controller as AnetController;

  define("AUTHORIZENET_LOG_FILE", "phplog");


function authorizeCreditCard($amount)
{
    $query = query("SELECT * FROM customer WHERE id = '{$_SESSION['u_id']}'");
    confirm($query);
    $row = fetch_array($query);
    $_SESSION['email'] = $row['email'];
    /* Create a merchantAuthenticationType object with authentication details
       retrieved from the constants file */
    $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
    $merchantAuthentication->setName(\SampleCodeConstants::MERCHANT_LOGIN_ID);
    $merchantAuthentication->setTransactionKey(\SampleCodeConstants::MERCHANT_TRANSACTION_KEY);
    
    // Set the transaction's refId
    $refId = 'ref' . time();

    // Create the payment data for a credit card
    $creditCard = new AnetAPI\CreditCardType();
    $creditCard->setCardNumber($_POST['creditCardNo']);
    $creditCard->setExpirationDate($_POST['expiryDate']);
    $creditCard->setCardCode($_POST['cardCode']);
    //creditCard->setExpirationDate("2038-12");
    //$creditCard->setCardCode("123");

    // Add the payment data to a paymentType object
    $paymentOne = new AnetAPI\PaymentType();
    $paymentOne->setCreditCard($creditCard);

    // Create order information
    $order = new AnetAPI\OrderType();
    $order->setInvoiceNumber("10101");
    $order->setDescription("Golf Shirts");

    // Set the customer's Bill To address
    $customerAddress = new AnetAPI\CustomerAddressType();
    $customerAddress->setFirstName($_SESSION['name']);
    $customerAddress->setCompany("Souveniropolis");
    $customerAddress->setAddress($_SESSION['ship_add']);
    $customerAddress->setCity($_SESSION['city_name']);
    $customerAddress->setState("TX");
    $customerAddress->setZip("44628");
    $customerAddress->setCountry("USA");

    // Set the customer's identifying information
    $customerData = new AnetAPI\CustomerDataType();
    $customerData->setType("individual");
    $customerData->setId("99999456654");
    $customerData->setEmail($_SESSION['email']);

    // Add values for transaction settings
    $duplicateWindowSetting = new AnetAPI\SettingType();
    $duplicateWindowSetting->setSettingName("duplicateWindow");
    $duplicateWindowSetting->setSettingValue("60");

    // Add some merchant defined fields. These fields won't be stored with the transaction,
    // but will be echoed back in the response.
    $merchantDefinedField1 = new AnetAPI\UserFieldType();
    $merchantDefinedField1->setName("customerLoyaltyNum");
    $merchantDefinedField1->setValue("1128836273");

    $merchantDefinedField2 = new AnetAPI\UserFieldType();
    $merchantDefinedField2->setName("favoriteColor");
    $merchantDefinedField2->setValue("blue");

    // Create a TransactionRequestType object and add the previous objects to it
    $transactionRequestType = new AnetAPI\TransactionRequestType();
    $transactionRequestType->setTransactionType("authOnlyTransaction"); 
    $transactionRequestType->setAmount($amount);
    $transactionRequestType->setOrder($order);
    $transactionRequestType->setPayment($paymentOne);
    $transactionRequestType->setBillTo($customerAddress);
    $transactionRequestType->setCustomer($customerData);
    $transactionRequestType->addToTransactionSettings($duplicateWindowSetting);
    $transactionRequestType->addToUserFields($merchantDefinedField1);
    $transactionRequestType->addToUserFields($merchantDefinedField2);

    // Assemble the complete transaction request
    $request = new AnetAPI\CreateTransactionRequest();
    $request->setMerchantAuthentication($merchantAuthentication);
    $request->setRefId($refId);
    $request->setTransactionRequest($transactionRequestType);

    // Create the controller and get the response
    $controller = new AnetController\CreateTransactionController($request);
    $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);


    if ($response != null) {
        // Check to see if the API request was successfully received and acted upon
        if ($response->getMessages()->getResultCode() == "Ok") {
            // Since the API request was successful, look for a transaction response
            // and parse it to display the results of authorizing the card
            $tresponse = $response->getTransactionResponse();
        
            if ($tresponse != null && $tresponse->getMessages() != null) {  
                add_order();

            }
            else{
                set_message("Transaction Failed 1");
                redirect("../public/customer_portal.php");
            }
            // Or, print errors if the API request wasn't successful
        }
        else{
            set_message("Transaction Failed 2");
            redirect("checkout.php");
        }      
    } else {
        echo  "No response returned";
    }

    return $response;
}

function add_order(){


    $query1 = query("SELECT id FROM city WHERE name = '{$_SESSION['city_name']}' ");
    confirm($query1); 
    $row = fetch_array($query1);

    $cus_id = $_SESSION['u_id'];
    $order_addr = $_SESSION['ship_add'];
        
    $order_date = date("Y-m-d");
    $order_time = date("h:i:sa");
    $delivery_status = false;
    $delivery_time = null;
    $delivery_date = null;

    query("INSERT INTO orderr(cus_id, ordering_address, shipment_id, date, time, delivery_time, delivery_date, total_bill) VALUES('$cus_id','$order_addr', '{$_SESSION['shipment_id']}','$order_date','$order_time','$delivery_time','$delivery_date','{$_SESSION['item_total']}')");
        
        
    foreach ($_SESSION as $name => $value) {
      
        if($value > 0){  

            if(substr($name, 0, 8) == "product_"){

                $length = strlen($name)-8;

                $product_id = substr($name, 8, $length);

                $query1 = query("SELECT max(id) AS id FROM orderr");
                confirm($query1); 
                $row = fetch_array($query1);

                query("INSERT INTO ordered_products(order_id, product_id, quantity, delivery_status) VALUES('{$row['id']}', '$product_id', '$value', '$delivery_status')");
                

                query("UPDATE stock SET quantity = quantity - $value WHERE product_id = $product_id");

            }
        }
    }

    mailtocustomer("Notification for online shopping transaction", 'Congrats! your transaction was successful. You have deposited $' . $_SESSION['item_total'] . ' to shopshipshop.com');

    foreach ($_SESSION as $name => $value)
    {
        if($value > 0)
        {  
            if(substr($name, 0, 8) == "product_")
            {
               unset($_SESSION[$name]);
            }
        } 
    }    
    redirect("../public/customer_portal.php");
    set_message("Order Made!");
    

}


    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;


function mailtocustomer($sub, $msg){

    require 'authorize/vendor_mail/autoload.php';

    $mail = new PHPMailer(true);                              
    try {
        //Server settings
        $mail->isSMTP();                                      
        $mail->Host = 'smtp.gmail.com';  
        $mail->SMTPAuth = true;                               
        $mail->Username = 'dukaanasaan@gmail.com';                 
        $mail->Password = 'ecomecom';   
        $mail->SMTPSecure = 'tls';                            
        $mail->Port = 587;                                    

        //Recipients
        $mail->setFrom($mail->Username, "shopshipshop");
        $mail->addAddress($_SESSION['email']);               
        //$_SESSION['email']

        //Content
        $mail->isHTML(false);
        $mail->Subject = $sub;        // Mail ka subject
        $mail->Body = $msg;              // Mail ka content

        $mail->send();
        //set_message("Message has been sent");
    } catch (Exception $e) {
        //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }

}

?>



