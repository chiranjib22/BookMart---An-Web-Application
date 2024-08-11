<?php

include 'config.php';

session_start();

global $user_id;
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/orders.css">
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

 <!-- Your order section -->
 <div class="heading">
    <h3><span style="color: #36D399;">YOUR </span>ORDERS</h3>
    <p> <a href="home.php"><span style="color: var(--light-white);">Home</span></a> / <span style="color: #36D399;">Shop </span></p>
 </div>

<!-- placed order --> 
   <section class = "placed-orders">

    <h1 class="title">Placed <span style="color: #36D399;">Orders</span></h1>
 
    <div class="box-container">

    <?php
         $order_query = mysqli_query($connection, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($order_query) > 0){
            while($fetch_orders = mysqli_fetch_assoc($order_query)){
      ?>
      <div class="box">
         <p> placed on : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
         <p> name : <span><?php echo $fetch_orders['name']; ?></span> </p>
         <p> number : <span><?php echo $fetch_orders['number']; ?></span> </p>
         <p> email : <span><?php echo $fetch_orders['email']; ?></span> </p>
         <p> address : <span><?php echo $fetch_orders['address']; ?></span> </p>
         <p> payment method : <span><?php echo $fetch_orders['method']; ?></span> </p>
         <p> your orders : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
         <p> total price : <span><?php echo $fetch_orders['total_price']; ?> TK.</span> </p>
         <p> payment status : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; } ?>;"><?php echo $fetch_orders['payment_status']; ?></span> </p>
         <?php
         // Assuming $fetch_orders['total_price'] contains the price value
         if($fetch_orders['method'] == 'Online Payment' && $fetch_orders['payment_status'] == 'pending'){
         $total_price = $fetch_orders['total_price'];
         echo '<p><a href="payment.php?price=' . $total_price . '" class="delete-btn">Payment?</a></p>';
         }
         ?>
      </div>
      <?php
       }
      }else{
         if(isset($_SESSION['user_id'])){
            echo '<p class="empty">no orders placed yet!</p>';
         }
         else{
            echo '<h1 class="title">Please login first to order from us!</h1>';
         }
      }
      ?>
    </div>
 
</section>
 <!-- footer part -->
 <?php include 'footer.php';?>



 <!-- custom js file link  -->
<script src="js/script.js"></script>
</body>
</html>