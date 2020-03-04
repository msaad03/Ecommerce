
            

<h1 class="page-header">
  Add a new Ad

</h1>


<div class="col-md-4">
    
    <form method="post">
    
        <div class="form-group">
            <label for="ad_name">Name</label>
            <input type="text" class="form-control" name="adName" required>
 
            <label for="link">Ad Link</label>
            <input type="text" class="form-control" name="adLink" required>
       
        <br>
            Select Ad Image: <input type="file" name="file" required>
        <br>
   
            <input type="submit" class="btn btn-primary" name="addad" value="Add">
        </div>      


    </form>

   <?php
        if(isset($_POST['addad']))
        {
           admin::addAd();
        }
    ?>

</div>

</div>

