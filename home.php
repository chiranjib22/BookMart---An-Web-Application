<?php

include 'config.php';

session_start();

global $user_id;
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   if(isset($_SESSION['user_id'])){
    $check_cart_numbers = mysqli_query($connection, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
 
    if(mysqli_num_rows($check_cart_numbers) > 0){
       $message[] = 'already added to cart!';
    }else{
       mysqli_query($connection, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
       $message[] = 'product added to cart!';
    }
    }
    else{
       header('location:login.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/home.css">
      <!-- font for page -->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Patua+One&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
       <!-- daisy ui -->
       <!-- <link href="https://cdn.jsdelivr.net/npm/daisyui@3.5.1/dist/full.css" rel="stylesheet" type="text/css" />
       <script src="https://cdn.tailwindcss.com"></script>  -->
</head>

<body>
<!-- nav and header -->
<?php include 'header.php'; ?>
<!-- home section -->
    <section class="home">

        <div class="content">
            <h3>Home Delivery to <span style="color: #36D399;">your Door</span></h3>
            <p>Welcome to <span style="color:#36D399; font-size: larger;">BookMart</span>, where stories come to life. Discover your next adventure among our vast collection of books
            </p>
            <a href="about.php" class="btn btn-lg">Discover more</a>
        </div>
    </section>
       
              

    <!-- latest product portion -->
    <section class="products">

      <h1 class="title">latest <span style="color: #36D399;">products</span></h1>
     
      <div class="box-container">

      <?php  
         $select_products = mysqli_query($connection, "SELECT * FROM `products` LIMIT 6") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <form action="" method="post" class="box">
         <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="couldn't load!">
         <div class="name"><?php echo $fetch_products['name']; ?></div>
         <div class="price"><?php echo $fetch_products['price']; ?> TK.</div>
         <input type="number" min="1" name="product_quantity" value="1" class="qty">
         <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
         <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
         <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
         <input type="submit" value="add to cart" name="add_to_cart" class="btn">
      </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
      </div>
     
        <div class="load-more" style="margin-top: 2rem; text-align:center">
           <a href="shop.php" class="option-btn load">Load More</a>
        </div>
     
     </section>
    <section class="about">

        <div class="flex">

            <div class="image">
                <img src="images/about-2.jpeg" alt="">
            </div>

            <div class="content">
                <h3><span style="color: #36D399;">About</span> us</h3>
                <p>Hi, we are TEAM-52 from HSTU. This is our level-3 semester-2 web application project. This project was supervised by Professor Dr. Ashis Kumar Mandal, Dept. of CSE, HSTU.
                </p>
                <a href="about.php" class="btn">read more</a>
            </div>

        </div>

    </section>

    <section class="home-contact">

        <div class="content">
            <h3>have any <span style="color: #36D399;"> questions?</span></h3>
            <p>If you have any question about our web site please contact with our hotline +123-456-789 or click this below</p>
            <a href="contact.php" class="white-btn">Contact us</a>
        </div>

    </section>
    
    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>