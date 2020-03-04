
<div class="col-md-12">
<div class="row">
<h1 class="page-header">
   All Orders

</h1>
</div>

<div class="row">
<table class="table table-hover">
    <thead>

      <tr>
           <th>Order Id</th>
           <th>Customer Name</th>
           <th>Ordering Adddress</th>
           <th>Date</th>
           <th>Time</th>
      </tr>
    </thead>
    <tbody>
        <!-- <tr>
            <td>21</td>
            <td>Nikon 234</td>

            <td><img src="http://placehold.it/62x62" alt=""></td>
            <td>Cameras</td>
            <td>456464</td>
            <td>Jun 2039</td>
           <td>Completed</td>
        </tr> -->
        
        <?php
          admin :: view_all_orders();
        ?>


    </tbody>
</table>
</div>