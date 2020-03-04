<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>


    <!-- login form starts from here -->
  <div class="Background">
  <div class="container">

          <h3 class="text-center bg-warning"><?php display_message(); ?></h3>
      <div class="card card-container">
          <img id="profile-img" class="profile-img-card" src="images/signup.png" />


          <!--Row for Tab Panel-->

<div class="row">

<div role="tabpanel">

  <!-- Nav tabs -->
  
  <ul class="nav nav-tabs" role="tablist" style="color: black">

    <li role="presentation" class="active"><a href="#customer" style="color: black" aria-controls="customer" role="tab" data-toggle="tab">Customer</a></li>
    <li role="presentation"><a href="#shop" style="color: black" aria-controls="shop" role="tab" data-toggle="tab">Shop</a></li>
    <li role="presentation"><a href="#shipper" style="color: black" aria-controls="shipper" role="tab" data-toggle="tab">Shipper</a></li>
    
  </ul>

  <br>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="customer">

      <form class="form-signin" method="post">

        <input type="text" name="cus_name" class="form-control"placeholder="Full Name*" required autofocus>
              
        <input type="text" name="cus_addr" class="form-control" placeholder="Address*" required>

        <input type="email" name="cus_email" class="form-control" placeholder="Email*" required>

        <input type="text" name="cus_phone" class="form-control" placeholder="Phone Number*" required>

        <input type="password" name="cus_pass" class="form-control" placeholder="Password*" required>

        <button class="btn btn-success btn-block" type="submit" name="customer_submit">Submit</button>

      </form>
       
    </div>

    <div role="tabpanel" class="tab-pane" id="shop">

      <form class="form-signin" method="post">

        <input type="text" name="shop_name" class="form-control"placeholder="Shop Name*" required autofocus>
        
        <input type="text" name="shop_addr" class="form-control" placeholder="Address*" required>

        <input type="text" name="shop_reg_no" class="form-control" placeholder="Registration Number*" required>

        <input type="email" name="shop_email" class="form-control" placeholder="Email*" required>

        <input type="text" name="shop_phone" class="form-control" placeholder="Phone Number*" required>

        <input type="password" name="shop_pass" class="form-control" placeholder="Password*" required>

        <button class="btn btn-success btn-block" type="submit" name="shop_submit">Submit</button>

      </form>
       
    </div>

    <div role="tabpanel" class="tab-pane" id="shipper">

      <form class="form-signin" method="post">

        <input type="text" name="sh_name" class="form-control"placeholder="Shipper Name*" required autofocus>
              
        <input type="text" name="sh_addr" class="form-control" placeholder="Address*" required>

        <input type="text" name="sh_reg_no" class="form-control" placeholder="Registration Number*" required>

        <input type="email" name="sh_email" class="form-control" placeholder="Email*" required>

        <input type="text" name="sh_phone" class="form-control" placeholder="Phone Number*" required>

        <input type="password" name="sh_pass" class="form-control" placeholder="Password*" required>

        <button class="btn btn-success btn-block" type="submit" name="shipper_submit">Submit</button>
            
      </form>
       
    </div>

    <?php
      if(isset($_POST['customer_submit']))
      {
        customer::signup();
      }
      else if(isset($_POST['shipper_submit']))
      {
        shipper::signup();
      }
      else if(isset($_POST['shop_submit']))
      {
        shop::signup();
      } 
    ?>

 </div>

</div>


</div><!--Row for Tab Panel-->
    
      </div><!-- /card-container -->
  </div><!-- /container -->
  
<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>

