<?php 
include 'config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/admin_page.css">
     <!-- font for page -->
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Patua+One&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
     <!-- daisy ui -->
     <link href="https://cdn.jsdelivr.net/npm/daisyui@3.5.1/dist/full.css" rel="stylesheet" type="text/css" />
     <script src="https://cdn.tailwindcss.com"></script>
     

</head>

<body>

    <?php include 'admin_header.php'; ?>
    <!-- admin dashboard section starts  -->
    <section class="dashboard">

        <h1 class="title">Dash<span style="color: #36d399;">board</span></h1>

        <div class="box-container">

            <!-- pending payment -->
            <div class="box">
                <?php
                    $total_pendings = 0;
                    $select_pending = mysqli_query($connection, "SELECT total_price FROM `orders` WHERE payment_status = 'pending'") or die('query failed');
                    if(mysqli_num_rows($select_pending) > 0){
                        while($fetch_pendings =         mysqli_fetch_assoc($select_pending)){
                        $total_price = $fetch_pendings['total_price'];
                        $total_pendings += $total_price;
                        };
                    };
                ?>
                <h3><?php echo $total_pendings; ?><span style="color: #36d399;">TK</span></h3>
                <p>Total pendings</p>
            </div>
            

            <!-- Complete Payments -->
            <div class="box">
            <?php
                $total_completed = 0;
                $select_completed = mysqli_query($connection, "SELECT total_price FROM `orders` WHERE payment_status = 'completed'") or die('query failed');
                if(mysqli_num_rows($select_completed) > 0){
                while($fetch_completed = mysqli_fetch_assoc($select_completed)){
                    $total_price = $fetch_completed['total_price'];
                    $total_completed += $total_price;
                    };
                };
            ?>
                <h3><?php echo $total_completed;?><span style="color: #36d399;">TK</span></h3>
                <p>Completed Payments</p>
            </div>
            

            <!-- orders -->
            <div class="box">
            <?php 
                $select_orders = mysqli_query($connection, "SELECT * FROM `orders`") or die('query failed');
                $number_of_orders = mysqli_num_rows($select_orders);
            ?>
                <h3><?php echo $number_of_orders; ?></h3>
                <p>Order Placed</p>
            </div>


            <!-- products -->
            <div class="box">
            <?php 
                $select_products = mysqli_query($connection, "SELECT * FROM `products`") or die('query failed');
                $number_of_products = mysqli_num_rows($select_products);
            ?>
                <h3><?php echo $number_of_products;?></h3>
                <p>Products Added</p>
            </div>
            

            <!-- users -->
            <div class="box">
            <?php 
                $select_users = mysqli_query($connection, "SELECT * FROM `users` WHERE user_type = 'user'") or die('query failed');
                $number_of_users = mysqli_num_rows($select_users);
            ?>
                <h3><?php echo $number_of_users; ?></h3>
                <p>Normal Users</p>
            </div>


            <!-- Admin box -->
            <div class="box">
            <?php 
                $select_admins = mysqli_query($connection, "SELECT * FROM `users` WHERE user_type = 'admin'") or die('query failed');
                $number_of_admins = mysqli_num_rows($select_admins);
            ?>
                <h3><?php echo $number_of_admins; ?></h3>
                <p>Admin Users</p>
            </div>
            

            <!-- Account box -->
            <div class="box">
            <?php 
                $select_account = mysqli_query($connection, "SELECT * FROM `users`") or die('query failed');
                $number_of_account = mysqli_num_rows($select_account);
            ?>
                <h3><?php echo $number_of_account; ?>
                </h3>
                <p>Total Accounts</p>
            </div>

            
            <!-- message box -->
            <div class="box">
                <?php 
                $select_messages = mysqli_query($connection, "SELECT * FROM `message`") or die('query failed');
                $number_of_messages = mysqli_num_rows($select_messages);
                ?>
                <h3><?php echo $number_of_messages; ?> </h3>
                <p>New Messages</p>
            </div>

        </div>
    </section>

    <!-- admin dashboard section ends -->

    <!-- custom admin js file link  -->
    <script src="js/admin_script.js"></script>

</body>

</html>