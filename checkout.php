<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['order_btn'])){

   $name = mysqli_real_escape_string($connection, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($connection, $_POST['email']);
   $method = mysqli_real_escape_string($connection, $_POST['method']);
   $address = mysqli_real_escape_string($connection, $_POST['flat'].', '. $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code']);
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = mysqli_query($connection, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   if(mysqli_num_rows($cart_query) > 0){
      while($cart_item = mysqli_fetch_assoc($cart_query)){
         $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      }
   }

   $total_products = implode(', ',$cart_products);

   $order_query = mysqli_query($connection, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

   if($cart_total == 0){
      $message[] = 'your cart is empty';
   }else{
      if(mysqli_num_rows($order_query) > 0){
         $message[] = 'order already placed!'; 
      }else{
         mysqli_query($connection, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
         $message[] = 'order placed successfully!';
         mysqli_query($connection, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      }
   }
   
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/checkout.css">
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

<div class="heading">
    <h3><span style="color: #36D399;"></span>CHECKOUT</h3>
    <p> <a href="home.php"><span style="color: #000000;">Home</span></a> / <span style="color: #36D399;">Checkout</span></p>
 </div>

<!-- placed order -->
<section class="display-order">

   <?php  
      $grand_total = 0;
      $select_cart = mysqli_query($connection, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
   ?>

   <p> <?php echo $fetch_cart['name']; ?> <span>(<?php echo $fetch_cart['price'].'TK'.' x '. $fetch_cart['quantity']; ?>)</span></p>

   <?php
      }
   }else{
      echo '<p class="empty">No orders placed yet!</p>';
   }
   ?>
    <div class="grand-total">Grand<span style="color: #36D399;">Total = </span><span><?php echo $grand_total;?></span>TK.</div> 
</section>

<!-- form section for checkout -->
<section class="checkout">

   <form action="" method="post">
      <h3><span style="color: #36D399; margin-top: 1rem;">Place Your Order</span></h3>
      <div class="flex">
         <div class="inputBox">
            <span>Your Name :</span>
            <input type="text" name="name" required="" placeholder="Enter Your Name">
         </div>
         <div class="inputBox">
            <span>Your Number :</span>
            <input type="number" name="number" required="" placeholder="Enter Your Number">
         </div>
         <div class="inputBox">
            <span>Your Email :</span>
            <input type="email" name="email" required="" placeholder="Enter Your Email">
         </div>
         <div class="inputBox">
            <span>Payment Method :</span>
            <select name="method">
               <option value="cash on delivery">Cash On Delivery</option>
               <option value="Online Payment">Online Payment</option>
               <!-- <option value="Nagad">Nagad</option>
               <option value="Rocket">Rocket</option>
               <option value="Bkash">Bkash</option> -->
            </select>
         </div>
         <div class="inputBox">
            <span>Enter Your Home Adress:</span>
            <input type="text" min="0" name="flat" required="" placeholder="Enter Your Home Address">
         </div>
         <div class="inputBox">
             <span>Enter Your Street Name:</span>
             <input type="text" name="street" required="" placeholder="Enter Your Street Name">
          </div>
          <div class="inputBox">
             <span>City Name:</span>
             <input type="text" name="city" required="" placeholder="Enter Your City Name ">
          </div>
          <div class="inputBox">
             <span>State:</span>
             <input type="text" name="state" required="" placeholder="Enter Your State Name">
          </div>
          <div class="inputBox">
             <span>Country:</span>
             <input type="text" name="country" required="" placeholder="Enter Your Country Name">
         </div>
         <div class="inputBox">
             <span>Pin code :</span>
             <input type="number" min="0" name="pin_code" required="" placeholder="Enter Pin 123456">
         </div>
      </div>
      <input type="submit" value="order now" class="btn" name="order_btn">
   </form>
 

 </section>
 <!-- footer part -->
 <?php include 'footer.php'?>

<!-- custom js file link  -->
<script src="js/script.js"></script>


</body>
</html>