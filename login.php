<?php 
include "config.php";

session_start(); //session (user or admin)

if(isset($_POST['submit'])){
   
   //fetch the login form information
   $email = mysqli_real_escape_string($connection, $_POST['email']);
   $password = mysqli_real_escape_string($connection, md5($_POST['password']));

   //fetch from the database
   $select_user = mysqli_query($connection, "SELECT * FROM `users` WHERE email = '$email' AND password = '$password'") or die ('query failed');

   //check the required user is already in database or not!
   if(mysqli_num_rows($select_user)>0){

      $row = mysqli_fetch_assoc($select_user);

      if($row['user_type'] == 'admin'){

         //admin session information storing
         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];

         header('location:admin_page.php');
      }
      elseif($row['user_type'] == 'user'){

         //user session information storing
         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');
      }
   }else{

      $message[] = 'incorrect email or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./css/login.css">

   <!-- daisy UI -->
   
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.5.1/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

     <!-- font for page -->
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Patua+One&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

</head>
<body>

<!-- <div class="message">
   <span>'.$message.'</span>
   <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
</div> -->

<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message">
      <span>'.$message.'</span>
      <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
   </div>';
   }
}
?>

   
<div class="form-container">

   <form action="" method="post">
      <h3 class = "login">login now</h3>
      <input type="email" name="email" placeholder="Enter your email" required class="box">
      <input type="password" name="password" placeholder="Enter your password" required class="box">
      <input type="submit" name="submit" value="login now" class="btn btn-outline btn-success text-lg">
      <p><span style="color: #36D399;">Don't have an account?</span> <a href="register.php">Register Now</a></p>
   </form>

</div>

</body>
</html>