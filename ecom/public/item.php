<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>

    <!-- Page Content -->
<div class="container">

       <!-- Side Navigation -->

        <?php include(TEMPLATE_FRONT . DS . "side_nav.php"); ?>


<?php 

    $query = query("SELECT * FROM product WHERE id = " . escape_string($_GET['id']) . " ");
    confirm($query);
    $row = fetch_array($query);

    $query2 = query("SELECT name FROM brand WHERE id = '{$row['brand_id']}' ");
    confirm($query2);
    $row2 = fetch_array($query2);

    $query3 = query("SELECT name FROM category WHERE id = '{$row['category_id']}' ");
    confirm($query3);
    $row3 = fetch_array($query3);

    $query5 = query("SELECT shop_id FROM stock WHERE product_id = " . escape_string($_GET['id']) . "");
    confirm($query5);
    $row5 = fetch_array($query5);

    $query4 = query("SELECT name FROM shop WHERE id = '{$row5['shop_id']}' ");
    confirm($query4);
    $row4 = fetch_array($query4);

?>

<div class="col-md-9">

<!--Row For Image-->

<div class="row">

    <div class="col-md-7">
       <img class="img-responsive" src="<?php echo $row['image']; ?>" alt="">

    </div>

    <div class="col-md-5">

        <div class="thumbnail">
         

    <div class="caption-full">
        <h4><a href="#"><?php echo $row['name']; ?></a></h4>
        <hr>
        <h4><?php echo "Price: $" . $row['price']?></h4>
        <h5><?php echo "Size: " . $row['size']; ?></h5>
        <h5><?php echo "Brand: " . $row2['name']; ?></h5>
        <h5><?php echo "Category: " . $row3['name']; ?></h5>
        <h5><?php echo "Shop Name: " . $row4['name']; ?></h5>
        <br>


    <!-- <div class="ratings">
     
        <p>
            <span class="glyphicon glyphicon-star"></span>
            <span class="glyphicon glyphicon-star"></span>
            <span class="glyphicon glyphicon-star"></span>
            <span class="glyphicon glyphicon-star"></span>
            <span class="glyphicon glyphicon-star-empty"></span>
            4.0 stars
        </p>
    </div> -->
    
    <form action="">
        <div class="form-group">
            <a href="../resources/cartValidate.php?add=<?php echo $row['id'] ?>" class="btn btn-primary">ADD TO CART</a>
        </div>
    </form>

    </div>
 
</div>

</div>


</div><!--Row For Image-->


        <hr>


<!--Row for Tab Panel-->

<div class="row">

<div role="tabpanel">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
    <li role="presentation"><a href="#rev" aria-controls="rev" role="tab" data-toggle="tab">Reviews</a></li>

    <?php
        if(isset($_SESSION['user']) && $_SESSION['user'] == 1 && isset($_SESSION['u_id'])) {

            $query = query("SELECT id FROM customer_reviews WHERE cus_id = {$_SESSION['u_id']} AND product_id = {$_GET['id']} ");
            confirm($query);
            //$row1 = fetch_array($query);

            // $query1 = query("SELECT order_id FROM ordered_products WHERE product_id = {$_GET['id']} delivery_status = 2");
            // confirm($query1);
            // $row2 = fetch_array($query1);

            $query1 = query("SELECT o.id FROM orderr o WHERE o.id IN (SELECT op.order_id FROM ordered_products op WHERE op.product_id = {$_GET['id']} AND op.delivery_status = 2) AND o.cus_id = {$_SESSION['u_id']} ");
            // confirm($query1);
            // $row2 = fetch_array($query1);


            if(mysqli_num_rows($query) < 1 && mysqli_num_rows($query1) > 0){ ?>
                <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Add a review</a></li>
    <?php }} ?>
 
  </ul>

  <!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
        <br>
        <p><?php echo $row['description']; ?></p>    
    </div>


    <div role="tabpanel" class="tab-pane" id="rev">
        <br>
        <hr>
    <?php
        $query4 = query("SELECT * FROM customer_reviews WHERE product_id = {$_GET['id']} ");
        confirm($query4);
        
        while($row4 = fetch_array($query4)){
            
            $query5 = query("SELECT name FROM customer WHERE id = {$row4['cus_id']} ");
            confirm($query5);
            $row5 = fetch_array($query5);

            echo "<div class='row'>
                    <div class='col-md-12'>
                        <b>". $row5['name'] ."</b>
                        <p>". $row4['review'] ."</p>
                    </div>
                </div>
                <hr>";
       }
        
    ?>


    </div>



    <div role="tabpanel" class="tab-pane" id="profile">

       

    <div class="col-md-6">
        
  <!--    <form class="form-inline" method="get">
       
        <div class="box">
            <h3>Your Rating</h3>
            <a class="glyphicon glyphicon-star b5" id="onestar"></a>
            <a class="glyphicon glyphicon-star b4" id="twostar"></a>
            <a class="glyphicon glyphicon-star b3" id="thirdstar"></a>
            <a class="glyphicon glyphicon-star b2" id="fourthstar"></a>
            <a class="glyphicon glyphicon-star b1" id="fivestar"></a>
        </div> -->

        <!-- <div class="box">
            <a class="ion-android-star b1"></a>
            <a class="ion-android-star b2"></a>
            <a class="ion-android-star b3"></a>
            <a class="ion-android-star b4"></a>
            <a class="ion-android-star b5"></a>
        </div> -->

<!--     </form>
 -->
    <form class="form-inline" method="post">

            <br>
            
            <h3>Add A review</h3>
    
             <div class="form-group">
                <textarea cols="60" rows="10" name="review" class="form-control"></textarea>
            </div>

             <br>
              <br>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="submit_review" value="SUBMIT">
            </div>
        </form>

        <?php
            if(isset($_POST['submit_review']))
                submit_review();
        ?>
            
    </div>

 </div>

 </div>

</div>


</div><!--Row for Tab Panel-->


</div><!--col-md-9 ends here-->

<?php //endwhile; ?>

</div>
    <!-- /.container -->
    <?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>
<!-- <script>
    
    $(document).ready(function(){
 
        load_product_data();
         
        function load_product_data()
        {
            $.ajax({
                url:"fetch.php",
                method:"POST",
                success:function(data)
                {
                    $('#product_list').html(data);
                }
            });
        }
        
}

</script> -->