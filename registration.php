<?php include 'header.php'; ?>
<center>    

<!-- <h1>Registration page</h1> -->
<?php

$first_name = $last_name = $email = $username = $password = "";

$first_name_err = $last_name_err = $email_err = $username_err = $password_err = "";

function secure_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

if($_SERVER['REQUEST_METHOD'] == "POST") {

    if(empty($_POST['first_name'])) {

        $first_name_err = "Your First Name is Required";
        
    }
    else{
        $first_name = secure_input($_POST['first_name']);

        if (!preg_match("/^[a-zA-Z]*$/", $first_name)) {
            $first_name_err = "Only letters allowed";
          }else{
            $output_name = $first_name;
            $first_name_err = "";
          }
    }

    if(empty($_POST['last_name'])) {

        $last_name_err = "Your Last Name is Required";
        
    }
    else{
        $last_name = secure_input($_POST['last_name']);

        if (!preg_match("/^[a-zA-Z]*$/",$last_name)) {
            $last_name_err = "Only letters allowed";
          }else{
            $output_name = $last_name;
          }
    }
    
    if(empty($_POST['email'])) {
    
        $email_err = "Your Email Address is Required";
        
    }
    else{
        $email = secure_input($_POST['email']);

        if (!filter_var($email ,  FILTER_VALIDATE_EMAIL)) {
            $email_err = "Your Email Address is not correct. Please Enter Your correct email.";
        } else{
            $output_email = $email;
          }

        
    }

    if(empty($_POST['username'])) {
    
        $username_err = "Your Account Username is Required";
        
    }
    else{
        $username = secure_input($_POST['username']);

        if (!preg_match("/^[a-zA-Z0-9]*$/",$username)) {
            $username_err = "Only letters and numbers allowed";
          }else{
            $output_name = $username;
          }

        
    }
    if(empty($_POST['password'])) {
    
        $password_err = "Your password is Required";
        
    }
    else{
        $password = secure_input($_POST['password']);

        if (!preg_match("/^[a-zA-Z0-9]*$/",$password)) {
            $password_err = "Only letters and numbers allowed";
          }else{
            $output_name = $password;
          }

        
    }

}


?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

First Name: <input type="text" name = "first_name" value = "<?php echo $first_name; ?>">
<span class="error"> <?php echo $first_name_err;?></span><br><br>

Last Name: <input type="text" name = "last_name" value = "<?php echo $last_name; ?>">
<span class="error"> <?php echo $last_name_err;?></span><br><br>


Email: <input type="text" name = "email" value = "<?php echo $email; ?>">
<span class="error"><?php echo $email_err;?></span><br><br>

Account username: <input type="text" name = "username" value = "<?php echo $username; ?>">
<span class="error"> <?php echo $username_err;?></span><br><br>

Account Password: <input type="text" name = "password" value = "<?php echo $password; ?>">
<span class="error"> <?php echo $password_err;?></span><br><br>

<input type="submit" value="Submit">
     

</form>
</center>



<?php

require "db_connect.php";

if (!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])) {
   
    $first_name = $_POST['first_name'];

    $last_name = $_POST['last_name'];
    
    $email = $_POST['email'];
    
    $username = $_POST['username'];
    
    $password = $_POST['password'];
    
    $sql = "INSERT INTO users (firstname, lastname, email, username, password) VALUES ('$first_name', '$last_name', '$email', '$username', '$password')";
    
    if ($conn->query($sql) === TRUE) {
       echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    

}


?>

<?php include 'footer.php'; ?> 