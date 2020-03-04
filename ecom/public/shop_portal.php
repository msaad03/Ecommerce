<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>


<?php 

    if(!isset($_SESSION['user'])  || $_SESSION['user'] != 3 ){
        redirect("logout.php");

    }


?>



  <div class="container">
          <h3 class="text-center bg-warning"><?php display_message(); ?></h3>
      <div class="card card-container">
          <!--Row for Tab Panel-->

<div class="row">

<div role="tabpanel">

  <!-- Nav tabs -->
  
  <ul class="nav nav-tabs" role="tablist">

    <li role="presentation"  class="active"><a href="#view_orders" aria-controls="view_orders" role="tab" data-toggle="tab" style="color: black">View Orders</a></li>
    <li role="presentation"><a href="#completed_orders" aria-controls="completed_orders" role="tab" data-toggle="tab" style="color: black">Completed Orders</a></li>
    <li role="presentation"><a href="#my_products" aria-controls="myproducts" role="tab" data-toggle="tab" style="color: black;">My Products</a></li>
    <li role="presentation"><a href="#add_product" aria-controls="add_product" role="tab" data-toggle="tab" style="color: black">Add Product</a></li>
    
  </ul>

  <br>

  <!-- Tab panes -->
  <div class="tab-content">

    <div role="tabpanel" class="tab-pane active" id="view_orders">
       
       <form method="POST">
        <table class="table table-striped">
            <thead>
              <tr>
               <th>Customer Name</th>
               <th>Shipper Name</th>
               <th>Product Id</th>
               <th>Product Quantity</th>
               <th>Product Total</th>
              </tr>
            </thead>
            <tbody style="color: black">
                <?php shop::view_my_orders(); ?>
            </tbody>
        </table>
      </form>

    </div>
    
    <div role="tabpanel" class="tab-pane" id="completed_orders">
      
      <form method="POST">
        <table class="table table-striped">
            <thead>
              <tr>
               <th>Customer Name</th>
               <th>Shipper Name</th>
               <th>Product Id</th>
               <th>Product Quantity</th>
               <th>Product Total</th>
              </tr>
            </thead>
            <tbody style="color: black">
                <?php shop::view_completed_orders(); ?>
            </tbody>
        </table>
      </form>

    </div> 


    <div role="tabpanel" class="tab-pane" id="my_products">

      <form method="POST">
        <table class="table table-striped">
            <thead>
              <tr>
               <th>Product Id</th>
               <th>Product Name</th>
               <th>Product Quantity</th>
               <th>Product Price</th>
              </tr>
            </thead>
            <tbody style="color: black">
                <?php shop::view_my_products(); ?>
            </tbody>
        </table>
      </form>

  </div>


    <div role="tabpanel" class="tab-pane" id="add_product">

    <form class="form-signin" method="POST" enctype="multipart/form-data">       

        <input type="text" name="p_name"
 class="form-control" placeholder="Product Name*" required autofocus>

        <select class="sel_opt" name="p_cat" required>
            <option selected>Select Category</option>  
            <?php get_category_options(); ?>
        </select>

        <input type="text" name="p_price" class="form-control" placeholder="Price*" required>

        <select class="sel_opt" name="p_brand" required>
            <option selected>Select Brand</option>  
            <?php get_brand_options(); ?>
        </select>

        <select class="sel_opt" name="p_size">
            <option selected>Select Size</option>
            <option>S</option>
            <option>M</option>
            <option>L</option>
            <option>-</option>
        </select>

        <input type="number" name="p_quantity" class="form-control" placeholder="Quantity*" required>

        <textarea name="description" placeholder="Description*" required></textarea><br>

        Select Product Image: <input type="file" name="file" required>
        
        <button class="btn btn-success btn-block" type="submit" name="add_product_submit">Add</button> 

        <?php
          if(isset($_POST['add_product_submit'])){
            shop::add_product();
          } 
        ?>

      </form>
       
    </div>

    

 </div>

</div>


</div><!--Row for Tab Panel-->
    
      </div><!-- /card-container -->

  
<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>

