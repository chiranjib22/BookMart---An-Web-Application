<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($connection, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_users.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/admin_user.css">
     <!-- font for page -->
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Patua+One&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

       <!-- daisy ui -->
      <link href="https://cdn.jsdelivr.net/npm/daisyui@3.5.1/dist/full.css" rel="stylesheet" type="text/css" />
      <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<?php include 'admin_header.php'?>
<!-- container portion -->

<section class="users">

   <h1 class="title"> User <span style="color: #36d399;">accounts</span> </h1>
     
   <div class="box-container">
      <?php
         $select_users = mysqli_query($connection, "SELECT * FROM `users`") or die('query failed');
         while($fetch_users = mysqli_fetch_assoc($select_users)){
      ?>

      <div class="box">
         <p> User id : <span><?php echo $fetch_users['id'];?></span></p>
         <p> Username : <span><?php echo $fetch_users['name'];?></span></p>
         <p> Email : <span><?php echo $fetch_users['email'];?></span></p>
         <p> User type : <span style="color:
         <?php 
         if($fetch_users['user_type'] == 'admin'){
            echo 'var(--orange)';}
         ?>"><?php echo $fetch_users['user_type'];?></span></p>

         <a href="admin_users.php?delete=<?php echo $fetch_users['id'];?>" onclick="return confirm('delete this user?');"><button class="btn btn-outline btn-error text-lg">Delete  User</button></a>
      </div>
      <?php 
         };
      ?>
   </div>
</section>

<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>