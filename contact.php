<?php

include 'config.php';

session_start();

global $user_id;
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}
if(isset($_POST['send'])){

   $name = mysqli_real_escape_string($connection, $_POST['name']);
   $email = mysqli_real_escape_string($connection, $_POST['email']);
   $number = $_POST['number'];
   $msg = mysqli_real_escape_string($connection, $_POST['message']);

   $select_message = mysqli_query($connection, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');

   if(mysqli_num_rows($select_message) > 0){
      $message[] = 'message sent already!';
   }else{
      mysqli_query($connection, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
      $message[] = 'message sent successfully!';
   }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/contact.css">
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

 <!-- contuct us -->
 <div class="heading">
    <h3><span style="color: #36D399;">Hello! </span> <?php if(isset($_SESSION['user_id'])) echo $_SESSION['user_name']; else echo '<br>Login first for contact with us!'; ?></h3>
    <p> <a href="home.php"><span style="color: var(--light-white);">Home</span></a> / <span style="color: #36D399;">Contact </span></p>
 </div>

 <!-- form section -->
<?php 
 if(isset($_SESSION['user_id'])) echo '<section class="contact">
    <form action="" method="post">
       <h3>Say <span style="color: #36D399;">Something!</span></h3>
       <input type="text" name="name" required="" placeholder="enter your name" class="box">
       <input type="email" name="email" required="" placeholder="enter your email" class="box">
       <input type="number" name="number" required="" placeholder="enter your number" class="box">
       <textarea name="message" class="box" placeholder="enter your message" id="" cols="30" rows="10"></textarea>
       <input type="submit" value="send message" name="send" class="btn">
    </form>
 </section>';
?>
 <!-- footer part -->
<?php include 'footer.php';?>




<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>