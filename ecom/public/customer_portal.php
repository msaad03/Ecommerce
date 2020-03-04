<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>


<?php 

    if(!isset($_SESSION['user'])  || $_SESSION['user'] != 1){
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

    <li role="presentation"  class="active"><a href="#pending" aria-controls="pending" role="tab" data-toggle="tab" style="color: black">Pending Orders</a></li>
    <li role="presentation"><a href="#completed" aria-controls="completed" role="tab" data-toggle="tab" style="color: black">Completed Orders</a></li>
    
  </ul>

  <br>

  <!-- Tab panes -->
  <div class="tab-content">

    <div role="tabpanel" class="tab-pane active" id="pending">
       
       <form method="POST">
        <table class="table table-striped">
            <thead>
              <tr>
               <th>Product Name</th>
               <th>Product Quantity</th>
               <th>Shop Name</th>
               <th>Shipper Name</th>
               <th>Product Total</th>
              </tr>
            </thead>
            <tbody style="color: black">
                <?php customer::pending_orders(); ?>
            </tbody>
        </table>
      </form>

    </div>
    
    <div role="tabpanel" class="tab-pane" id="completed">
      
      <form method="POST">
        <table class="table table-striped">
            <thead>
              <tr>
               <th>Product Name</th>
               <th>Product Quantity</th>
               <th>Shop Name</th>
               <th>Shipper Name</th>
               <th>Product Total</th>
              </tr>
            </thead>
            <tbody style="color: black">
                <?php customer::completed_orders(); ?>
            </tbody>
        </table>
      </form>

    </div> 


 </div>

</div>


</div><!--Row for Tab Panel-->
    
      </div><!-- /card-container -->

  
<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>

