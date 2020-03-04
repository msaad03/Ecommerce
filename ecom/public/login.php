<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>


    <!-- login form starts from here -->
  <div class="Background">
  <div class="container">

          <h3 class="text-center bg-warning"><?php display_message(); ?></h3>
      <div class="card card-container">
          <img id="profile-img" class="profile-img-card" src="images/login.png" />
          <p id="profile-name" class="profile-name-card"></p>
          <form class="form-signin" method="post">
        
              <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email" required autofocus>
              <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
            
                <center>
                  <label class="radio-inline">
                    <input type="radio" name="optradio" value="1" checked>Customer
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="optradio" value="2">Shipper
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="optradio" value="3">Shop
                  </label>
                </center>

              <br>
              
              <button class="btn btn-success btn-block" type="submit" name="login">LogIn</button>
            </form>
            <form class="form-signin" method="post">
              <button class="btn btn-warning btn-block" type="submit" name="signup">SignUp</button>
            </form>

          <?php
            if(isset($_POST['login']) && $_POST['optradio'] == "1")
            {
              customer::login();
            }
            else if(isset($_POST['login']) && $_POST['optradio'] == "2")
            {
              shipper::login();
            }
            else if(isset($_POST['login']) && $_POST['optradio'] == "3")
            {
              shop::login();
            }
            else if(isset($_POST['signup']))
            {
              redirect("signup.php");
            }
          ?>


      </div><!-- /card-container -->
  </div><!-- /container -->


<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>

