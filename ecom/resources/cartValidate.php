<?php require_once("config.php"); ?>

<?php 

if(isset($_GET['add'])){

    $query = query("SELECT * FROM stock WHERE product_id = " .escape_string($_GET['add']). " ");
    confirm($query);

    while($row = fetch_array($query)){

      if($row['quantity'] != $_SESSION['product_' . $_GET['add']]){
        $_SESSION['product_' . $_GET['add']]++;
        redirect("../public/cart.php");
      }
      else{
        set_message("We only have " . $row['quantity'] . " pieces available");
        redirect("../public/cart.php");
      }

    }

  }

  if(isset($_GET['remove'])){

    $_SESSION['product_' . $_GET['remove']]--;

    if($_SESSION['product_' . $_GET['remove']] < 1){
      unset($_SESSION['item_total']);
      unset($_SESSION['item_quantity']);
      redirect("../public/cart.php");
      //redirect("cart.php");
    }
    else{ 
      redirect("../public/cart.php");
      //redirect("cart.php");
    }
  }

  if(isset($_GET['delete'])){

    $_SESSION['product_' . $_GET['delete']] = '0';
    unset($_SESSION['item_total']);
    unset($_SESSION['item_quantity']);
    redirect("../public/cart.php");
    //redirect("cart.php");
  }


  function cart(){

    $total = 0;
    $item_quantity = 0;

    foreach ($_SESSION as $name => $value) {
      
      if($value > 0){  

        if(substr($name, 0, 8) == "product_"){

          $length = strlen($name)-8;

          $id = substr($name, 8, $length);

          $query1 = query("SELECT * FROM product WHERE id = " .escape_string($id). " ");
          confirm($query1);

          while($row = fetch_array($query1)){

            $sub = $row['price'] * $value;
            $item_quantity += $value;

$product = <<<DELIMETER

<tr>
  <td>{$row['name']}</td>
  <td>&#36;{$row['price']}</td>
  <td>{$value}</td>
  <td>&#36;{$sub}</td>
  <td>
    <a class='btn btn-warning' href="../resources/cartValidate.php?remove={$row['id']}"><span class='glyphicon glyphicon-minus'></span></a>
    <a class='btn btn-success' href="../resources/cartValidate.php?add={$row['id']}"><span class='glyphicon glyphicon-plus'></span></a>
    <a class='btn btn-danger' href="../resources/cartValidate.php?delete={$row['id']}"><span class='glyphicon glyphicon-remove'></span></a>
  </td>
</tr>

DELIMETER;

          echo $product;
        }

        $_SESSION['item_total'] = $total += $sub;
        $_SESSION['item_quantity'] = $item_quantity;

      }
    }
  }
}


  
?>













