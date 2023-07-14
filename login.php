<?php include 'header.php'; ?>

<?php 
require "db_connect.php";

if (isset($_SESSION['user_id'])) {
    header('Location: ./admin/dashboard.php');
}

$username = $password = "";

$username_err = $password_err = $msg = "";

function secure_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

if($_SERVER['REQUEST_METHOD'] == 'POST') {

if(empty($_POST['username'])) {
    $username_err = "username is required";
}else {
    $username = secure_input($_POST['username']);
}

if(empty($_POST['password'])) {
    $password_err = "password is required";
} else {
    $password = secure_input($_POST['password']);
}

if (!empty($username) && !empty($password)) {

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);
    
if($result->num_rows>0){

    while ($row = $result->fetch_assoc()) {
          
          $_SESSION['user_id'] = $row['user_id'];
          $_SESSION['role'] = $row['role'];

    }
   
    if($result->num_rows == 1){
        header('Location: ./admin/dashboard.php');
    }
} else {
    $msg = "Your username and password combination is not correct! Please enter correct details!";
}

} 

}

?>

<center>
<?php echo $msg; ?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

Account username: <input type="text" name = "username" value = "<?php echo $username; ?>">
<span class="error"> <?php echo $username_err;?></span><br><br>

Account Password: <input type="password" name = "password" value = "">
<span class="error"> <?php echo $password_err;?></span><br><br>

<input type="submit" value="Login">
     

</form>
</center>
     
<?php include 'footer.php'; ?> 
