
            

<h1 class="page-header">
  Add a new category

</h1>


<div class="col-md-4">
    
    <form method="post">
    
        <div class="form-group">
            <label for="category-name">Name</label>
            <input type="text" class="form-control" name="catName" required>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" name="addcat" value="Add Category">
        </div>      


    </form>

   <?php
        if(isset($_POST['addcat']))
        {
            admin::addCat();
        }
    ?>

</div>


<!-- <div class="col-md-8">

    <table class="table">
        
        <thead>
        <tr>
            <th>id</th>
            <th>Title</th>
        </tr>
            </thead> -->


   <!--  <tbody>
        <tr>
            <td>20</td>
            <td>Example Title</td>
        </tr>
    </tbody> -->

   <!--      </table>
 -->
</div>

