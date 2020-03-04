<?php require_once("../../resources/config.php"); ?>

<?php include(TEMPLATE_BACK . DS . "header.php"); ?>


<?php 

    if((!isset($_SESSION['user']) || $_SESSION['user'] != 4) || !isset($_SESSION['name'])){
        session_destroy();
        redirect("../admin_login.php"); 
    }
    

?>

    <h3 class="text-center bg-warning"><?php display_message(); ?></h3>

        <div id="page-wrapper">

            <div class="container-fluid">

                    <?php 
                        if($_SERVER['REQUEST_URI'] == "/ecom/public/admin/" || $_SERVER['REQUEST_URI'] == "/ecom/public/admin/index.php"){
                            include(TEMPLATE_BACK . DS . "admin-content.php");
                        } 

                        if(isset($_GET['orders'])){

                          include(TEMPLATE_BACK . DS . "orders.php");  

                        }

                        if(isset($_GET['addcategory'])){

                          include(TEMPLATE_BACK . DS . "addcategory.php");  

                        }

                        if(isset($_GET['viewcategory'])){

                          include(TEMPLATE_BACK . DS . "viewcategory.php");  

                        }
                        if(isset($_GET['add_ads'])){

                          include(TEMPLATE_BACK . DS . "add_ads.php");  

                        }
                    ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include(TEMPLATE_BACK . DS . "footer.php"); ?>