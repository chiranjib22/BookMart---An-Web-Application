<?php 
include 'config.php';

if(isset($_POST['submit'])){

   //input from from
   $name = mysqli_real_escape_string($connection, $_POST['name']);
   $email = mysqli_real_escape_string($connection, $_POST['email']);
   $password = mysqli_real_escape_string($connection, md5($_POST['password']));
   $cpassword = mysqli_real_escape_string($connection, md5($_POST['cpassword']));
   $user_type = $_POST['user_type'];

   //fetch from database 
   $select_user = mysqli_query($connection , "SELECT * FROM `users` WHERE email = '$email'") or die ('query failed');

   //check double user
   if(mysqli_num_rows($select_user) > 0){
      $message[] = 'user already exist!';
   }else{

      //check confirm password
      if($password != $cpassword){
         $message[]= 'confirm password not matched!';
      }else{
         //inserting ihe information
         mysqli_query($connection, "INSERT INTO `users` (name , email , password, user_type) VALUES ('$name', '$email', '$cpassword', '$user_type')") or die('query failed!');

         $message[]= 'registered successfully!';
         header('location:login.php');
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
   <title>Register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./css/register.css">
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
      foreach($message as $message)
      {
         echo '<div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>' ; 
      }
   }
?>
   
<div class="form-container">

   <form action="" method="post">
      <h3>register now</h3>
      <input type="text" name="name" placeholder="Enter Your Name...." required class="box">
      <input type="email" name="email" placeholder="Enter Your Email....." required class="box">
      <input type="password" name="password" placeholder="Enter Your Password....." required class="box">
      <input type="password" name="cpassword" placeholder="Confirm Your Password....." required class="box">
      <select name="user_type" class="box">
         <option value="user"><span style="color: #36D399;">User</span></option>
         <option value="admin">admin</option>
      </select>
      <input type="submit" name="submit" value="Register now" class="btn btn-outline btn-success text-lg">
      <p><span style="color: #36D399;">Already have an account?</span> <a href="login.php">Login Now</a></p>
   </form>

</div>

</body>
</html>