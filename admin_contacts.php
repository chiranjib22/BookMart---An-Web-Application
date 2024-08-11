<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($connection, "DELETE FROM `message` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_contacts.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/admin_contacts.css">
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
     <!-- placed order html -->

   <section class="messages">

      <h1 class="title"><span style="color: #36d399;">Mess</span>ages</h1>
     
      <div class="box-container">
      <?php
      $select_message = mysqli_query($connection, "SELECT * FROM `message`") or die('query failed');
      if(mysqli_num_rows($select_message) > 0){
         while($fetch_message = mysqli_fetch_assoc($select_message)){   
      ?>
         <div class = "box">
            <p>User ID: <span><?php echo $fetch_message['user_id'];?></span></p>
            <p>Name: <span><?php echo $fetch_message['name'];?></span>
            <p>Number: <span><?php echo $fetch_message['number'];?></span></p>
            <p>Email: <span><?php echo $fetch_message['email'];?></span></p>
            <p>Message: <span><?php echo $fetch_message['message'];?></span></p>

            <a href="admin_contacts.php?delete=
            <?php 
               echo $fetch_message['id']; ?>" onclick="return confirm('delete this message?');" class = "btn btn-outline btn-error text-lg">Delete Message</a>
         </div>
      <?php 
         };
      }else{
         echo '<p class="empty">you have no messages!</p>';
      }
      ?>
      </div>
   </section>

   <!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>
   </body>
</html>