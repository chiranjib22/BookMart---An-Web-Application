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
    <title>About</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/about.css">
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

 <!-- about us section -->
 <div class="heading">
    <h3><span style="color: #36D399;">About</span> us</h3>
    <p> <a href="home.php"><span style="color: var(--light-white);">Home</span></a> / <span style="color: #36D399">About</span> </p>
 </div>
<!-- whu chose us portion -->
<section class="about">

    <div class="flex">
 
       <div class="image">
          <img src="images/about-2.jpeg" alt="">
       </div>
 
       <div class="content">
          <h3>Why choose us?</h3>
          <p>At BookMart, we're not just another online bookstore – we're your gateway to a world of literary exploration and discovery.</p>
          <a href="contact.php" class="btn">Contact Us</a>
       </div>
 
    </div>
 
 </section>

 <!-- review section -->
 <section class="reviews">

    <h1 class="title">Client's <span style="color: #36D399;">Reviews</span></h1>
 
    <div class="box-container">
 
       <div class="box">
          <img src="images/pic-1.png" alt="">
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt ad, quo labore fugiat nam accusamus quia. Ducimus repudiandae dolore placeat.</p>
          <div class="stars">
             <i class="fas fa-star"></i>
             <i class="fas fa-star"></i>
             <i class="fas fa-star"></i>
             <i class="fas fa-star"></i>
             <i class="fas fa-star-half-alt"></i>
          </div>
          <h3><span style="color: #36D399;">Md Sabbir Hosen</span></h3>
       </div>
 
       <div class="box">
          <img src="images/pic-2.png" alt="">
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt ad, quo labore fugiat nam accusamus quia. Ducimus repudiandae dolore placeat.</p>
          <div class="stars">
             <i class="fas fa-star"></i>
             <i class="fas fa-star"></i>
             <i class="fas fa-star"></i>
             <i class="fas fa-star"></i>
             <i class="fas fa-star-half-alt"></i>
          </div>
          <h3><span style="color: #36D399;">Afsana Akter</span></h3>
       </div>
 
       <div class="box">
          <img src="images/pic-3.png" alt="">
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt ad, quo labore fugiat nam accusamus quia. Ducimus repudiandae dolore placeat.</p>
          <div class="stars">
             <i class="fas fa-star"></i>
             <i class="fas fa-star"></i>
             <i class="fas fa-star"></i>
             <i class="fas fa-star"></i>
             <i class="fas fa-star-half-alt"></i>
          </div>
          <h3><span style="color: #36D399;">Chiranjib Chakrabarti</span></h3>
       </div>
 
       <div class="box">
          <img src="images/pic-4.png" alt="">
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt ad, quo labore fugiat nam accusamus quia. Ducimus repudiandae dolore placeat.</p>
          <div class="stars">
             <i class="fas fa-star"></i>
             <i class="fas fa-star"></i>
             <i class="fas fa-star"></i>
             <i class="fas fa-star"></i>
             <i class="fas fa-star-half-alt"></i>
          </div>
          <h3><span style="color: #36D399;">Mst Sathi Begum</span></h3>
       </div>
 
       <div class="box">
          <img src="images/pic-5.png" alt="">
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt ad, quo labore fugiat nam accusamus quia. Ducimus repudiandae dolore placeat.</p>
          <div class="stars">
             <i class="fas fa-star"></i>
             <i class="fas fa-star"></i>
             <i class="fas fa-star"></i>
             <i class="fas fa-star"></i>
             <i class="fas fa-star-half-alt"></i>
          </div>
          <h3><span style="color: #36D399;">Md Ridwan Hasan</span></h3>
       </div>
 
       <div class="box">
          <img src="images/pic-6.png" alt="">
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt ad, quo labore fugiat nam accusamus quia. Ducimus repudiandae dolore placeat.</p>
          <div class="stars">
             <i class="fas fa-star"></i>
             <i class="fas fa-star"></i>
             <i class="fas fa-star"></i>
             <i class="fas fa-star"></i>
             <i class="fas fa-star-half-alt"></i>
          </div>
          <h3><span style="color: #36D399;">Lorance Bisnuye</span></h3>
       </div>
 
    </div>
 
 </section>
<!-- footer section -->
<?php include 'footer.php';?>









<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>

</html>