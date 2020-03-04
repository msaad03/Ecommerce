<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>


<?php 

    if(!isset($_SESSION['user'])){
        $_SESSION['direct_cart'] = 1;
        redirect("login.php");
    }
?>

    <!-- Page Content -->
    <div class="container">

    <!-- /.row --> 

  <div class="row">
    <h4 class="text-center bg-danger"> <?php display_message(); ?> </h4>
    <h1>Checkout</h1>


  <!--  ***********SELECT SHIPPER*************-->          


<form method="post">

<div class="col-xs-8 pull-left ">
  <h2>Shipping</h2>
        <select class="sel_opt" name="p_shipper" required>
        <option selected>Select Shipper*</option>  
          <?php get_shippers(); ?>
        </select>
  <button name="gen_bill" class="btn btn-success" type="submit">Generate Bill</button>
</div>

</form>
  <form method="post">
  
<div class="col-xs-8 pull-left ">
  <br>
  <input type="text-center" name="creditCardNo" placeholder="Enter Credit Card Number" required><br><br>
  <input type="text-center" name="expiryDate" placeholder="Enter Expiry Date" required><br><br>
  <input type="password" name="cardCode" placeholder="Enter Card Code" required><br><br>
  <button name="checkout" class="btn btn-danger" type="submit">Checkout</button>
</div>
</form>


<?php
  if (isset($_POST['checkout'])) {
    $_SESSION['item_total'] = $_SESSION['ship_charge'];
    if (!defined('DONT_RUN_SAMPLES')) {
      authorizeCreditCard($_SESSION['item_total']);
    }
  }

?>


<?php
  if (isset($_POST['gen_bill'])) {
    
    $_SESSION['shipment_id'] = $_POST['p_shipper'];

    $query = query("SELECT * FROM shipment_charges WHERE id = '{$_POST['p_shipper']}' ");
    confirm($query); 
    $row = fetch_array($query);

    $_SESSION['ship_id'] = $row['shipper_id'];
    $_SESSION['ship_ch'] = $row['charges'];

    $_SESSION['ship_charge'] = $row['charges'];
    $_SESSION['ship_charge'] += $_SESSION['item_total'];
//    $_SESSION['shipment_id'] = $row['id'];
    //$_SESSION['shipper_id'] = $row['shipper_id'];


?>

<!--  ***********CART TOTALS*************-->
      


<div class="col-xs-4 pull-right ">
  <h2>Order Details</h2>

  <table class="table table-bordered" cellspacing="0">
    

<tr class="cart-subtotal">
      <th>Items:</th>
      <td>
        <span class="amount">
          <?php 
            echo isset($_SESSION['item_quantity']) ? $_SESSION['item_quantity'] : $_SESSION['item_quantity'] = "0";
          ?>
        </span>
      </td>
    </tr>


  <tr class="order-total">
<th>Item Total</th>
<td><strong><span class="amount">&#36;<?php 
    echo $_SESSION['item_total'];
  ?>
</span></strong> </td>
</tr>


    <tr class="cart-subtotal">
      <th>Shipper:</th>
      <td>
        <span class="amount">
          <?php 

            $query2 = query("SELECT name FROM shipper WHERE id = '{$_SESSION['ship_id']}'"); 
            $row2 = fetch_array($query2);

            echo $row2['name'];
          ?>
        </span>
      </td>
    </tr>

    
    <tr class="order-total">
<th>Shipment Charges</th>
<td><strong><span class="amount">&#36;<?php 
    echo $_SESSION['ship_ch'];
  ?>
</span></strong> </td>
</tr>


<tr class="order-total">
<th>Total Bill</th>
<td><strong><span class="amount">&#36;<?php 
    echo isset($_SESSION['item_total']) ? $_SESSION['ship_charge'] : $_SESSION['item_total'] = "0";
  ?>
</span></strong> </td>
</tr>


</tbody>

</table>

</div><!-- CART TOTALS-->

<?php } ?>
 </div><!--Main Content-->


    </div>
    <!-- /.container -->

<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>
