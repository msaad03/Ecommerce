<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>

    <!-- Page Content -->
    <div class="container">

<!-- /.row --> 

<div class="row">
      <h4 class="text-center bg-danger"> <?php display_message(); ?> </h4>
      <h1>Cart</h1>

<form method="POST">
    <table class="table table-striped">
        <thead>
          <tr>
           <th>Product</th>
           <th>Price</th>
           <th>Quantity</th>
           <th>Sub-total</th>
     
          </tr>
        </thead>
        <tbody>

            <?php cart(); ?>
        </tbody>
    </table>

  <h2>Shipping Address</h2>

  <input type="text" name="ship_add" placeholder="Address*" required>

  <select name="city_name" required>
  <option selected>Select City*</option>  
    <?php get_city(); ?>
  </select>

  <br>
  <br>

<button class="btn btn-success" type="submit" name="proceed">Proceed</button>

</form>

  <?php
    if(isset($_POST['proceed']) && $_POST['city_name'] != "Select City*"){
      set_add();
    }
  ?>


 </div><!--Main Content-->


    </div>
    <!-- /.container -->

<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>
