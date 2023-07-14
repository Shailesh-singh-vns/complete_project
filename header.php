<?php
session_start();
$root = "http://localhost/projects/cms";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo $root;?>/">CMS</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="<?php echo $root;?>/">Home</a></li>
      
    </ul>
    <ul class="nav navbar-nav navbar-right">
    <?php 
     if (!isset($_SESSION['user_id'])) {
        ?>
         <li><a href="<?php echo $root;?>/registration.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="<?php echo $root;?>/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        <?php
      }
      ?>
      
     
      <?php 
     if (isset($_SESSION['user_id'])) {
        ?>
        <li><a href="<?php echo $root;?>/admin/dashboard.php"><span class="glyphicon glyphicon-user"></span>Dashboard</a></li>
        <li><a href="<?php echo $root;?>/admin/logout.php"><span class="glyphicon glyphicon-user"></span>Logout</a></li>
        <?php
      }
      ?>
    </ul>
  </div>
</nav>