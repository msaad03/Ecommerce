<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>


<?php 

    if(!isset($_SESSION['user']) || $_SESSION['user'] != 2){
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

    <li role="presentation"  class="active"><a href="#collect_orders" aria-controls="collect_orders" role="tab" data-toggle="tab" style="color: black;">Collect Orders</a></li>
    <li role="presentation"><a href="#view_orders" aria-controls="view_orders" role="tab" data-toggle="tab" style="color: black;">Collected Orders</a></li>
    <li role="presentation"><a href="#view_delivered_orders" aria-controls="view_delivered_orders" role="tab" data-toggle="tab" style="color: black;">View Delivered Orders</a></li>
    <li role="presentation"><a href="#add_city" aria-controls="add_city" role="tab" data-toggle="tab" style="color: black;">Add City</a></li>
    <li role="presentation"><a href="#my_cities" aria-controls="my_cities" role="tab" data-toggle="tab" style="color: black;">My Cities</a></li>
    
  </ul>

  <br>

  <!-- Tab panes -->
  <div class="tab-content">

    <div role="tabpanel" class="tab-pane active" id="collect_orders">
       
      <form method="POST">
        <table class="table table-striped">
            <thead>
              <tr>
               <th>Shop Name</th>
               <th>Shop Address</th>
               <th>Product Id</th>
              </tr>
            </thead>
            <tbody style="color: black">
                <?php shipper::collect_orders(); ?>
            </tbody>
        </table>
      </form>
       
    </div>


    <div role="tabpanel" class="tab-pane" id="view_orders">
       
      <form method="POST">
        <table class="table table-striped">
            <thead>
              <tr>
               <th>Customer Name</th>
               <th>Customer Address</th>
               <th>Shop Name</th>
               <th>Product Id</th>
               <th>Charges</th>
              </tr>
            </thead>
            <tbody style="color: black">
                <?php shipper::view_my_orders(); ?>
            </tbody>
        </table>
      </form>
       
    </div>

    <div role="tabpanel" class="tab-pane" id="view_delivered_orders">

      <form method="POST">
        <table class="table table-striped">
            <thead>
              <tr>
               <th>Customer Name</th>
               <th>Customer Address</th>
               <th>Shop Name</th>
               <th>Product Id</th>
               <th>Charges</th>
              </tr>
            </thead>
            <tbody style="color: black">
                <?php shipper::view_delivered_orders(); ?>
            </tbody>
        </table>
      </form>

    </div>


  <div role="tabpanel" class="tab-pane" id="add_city">

    <form class="form-signin" method="POST">       
      <select class="sel_opt" name="c_name" required autofocus>
        <option selected>Select City</option>  
          <?php get_city(); ?>
      </select>

        <input type="number" name="s_charge" class="form-control" placeholder="Shipment Charges*" required>
        <button class="btn btn-success btn-block" type="submit" name="add_city_submit">Add</button> 

        <?php
          if(isset($_POST['add_city_submit']))
          {
            shipper::add_city();
          } 
        ?>

      </form>
       
    </div>


    <div role="tabpanel" class="tab-pane" id="my_cities">
       
      <form method="POST">
        <table class="table table-striped">
            <thead>
              <tr>
               <th>City Name</th>
              </tr>
            </thead>
            <tbody style="color: black">
                <?php shipper::view_my_cities(); ?>
            </tbody>
        </table>
      </form>

    </div>  

      

 </div>

</div>


</div><!--Row for Tab Panel-->
    
      </div><!-- /card-container -->

  
<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>

