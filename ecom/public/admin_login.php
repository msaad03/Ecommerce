<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>


    <!-- login form starts from here -->
  <div class="Background">
  <div class="container">

          <h3 class="text-center bg-warning"><?php display_message(); ?></h3>
      <div class="card card-container" style="background-color: blue">
          <img id="profile-img" class="profile-img-card" src="../public/images/login.png" />
          <p id="profile-name" class="profile-name-card"></p>
          <form class="form-signin" method="post">

              
              <br>

              <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email" required autofocus>
              <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>

              <br>
              
              <button class="btn btn-success btn-block" type="submit" name="admin_login">LogIn</button>
          </form><!-- /form -->

            <?php 
            
              if(isset($_POST['admin_login']))
              admin::login(); 
            ?>
      </div><!-- /card-container -->
  </div><!-- /container -->  

<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>

