<?php

include 'config.php';

session_start();

global $user_id;
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}
if(isset($_POST['update_cart'])){
   $cart_id = $_POST['cart_id'];
   $cart_quantity = $_POST['cart_quantity'];
   mysqli_query($connection, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
   $message[] = 'cart quantity updated!';
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($connection, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
   header('location:cart.php');
}

if(isset($_GET['delete_all'])){
   mysqli_query($connection, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   header('location:cart.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="./css/cart.css">
     <!-- font for page -->
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Patua+One&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
       <!-- daisy ui -->
       <!-- <link href="https://cdn.jsdelivr.net/npm/daisyui@3.5.1/dist/full.css" rel="stylesheet" type="text/css" />
       <script src="https://cdn.tailwindcss.com"></script> 
    -->
</head>

<body>
<!-- nav and header -->
<?php include 'header.php';?>

 <!-- Your product  section -->
 <div class="heading">
    <h3><span style="color: #36D399;">SHOPPING </span>CART</h3>
    <p> <a href="home.php"><span style="color: var(--light-white);">Home</span></a> / <span style="color: #36D399;">Cart</span></p>
 </div>

 <!-- placed order -->
 <section class="shopping-cart">

    <h1 class="title">PRODUCT<span style="color: #36D399;">ADDED</span></h1>
 
    <div class="box-container">
      <?php
         $grand_total = 0;
         $select_cart = mysqli_query($connection, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){   
      ?>
      <div class="box">
         <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('delete this from cart?');"></a>
         <img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_cart['name']; ?></div>
         <div class="price"><?php echo $fetch_cart['price']; ?>TK.</div>
         <form action="" method="post">
            <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
            <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
            <input type="submit" name="update_cart" value="update" class="option-btn">
         </form>
         <div class="sub-total"> sub total : <span><?php echo $sub_total = ($fetch_cart['quantity'] * $fetch_cart['price']); ?>TK.</span> </div>
      </div>
      <?php
      $grand_total += $sub_total;
         }
      }else{

         if(isset($_SESSION['user_id'])) echo '<p class="empty">your cart is empty</p>';
         else echo '<p class="empty">Login First!</p>';
      }
      ?>
   </div>
 

 <!-- delete btn design -->
 <div style="margin-top: 2rem; text-align:center;">
    <a href="cart.php?delete_all" class="delete-btn <?php echo ($grand_total > 1)? '':'disabled';?>" onclick="return confirm('delete all from cart?');">delete all</a>
 </div>

 <!-- grand total part -->
 <div class="cart-total grand total">
    <p class="grand-p">Grand Total: <span style="color: #36D399;"><?php echo $grand_total;?>Tk.</span></p>
    <div class="flex">
       <a href="shop.php" class="option-btn"><span style="color: white;">continue shopping</span></a>
       <a href="checkout.php" class="btn <?php echo ($grand_total > 1)? '':'disabled';?> btn-customize">proceed to checkout</a>
    </div>
 </div>

 </section>
 <!-- footer part -->
 <?php include 'footer.php';?>

 <!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>