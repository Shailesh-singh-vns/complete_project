<?php
include "../header.php";

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}
?>

<?php

require "../db_connect.php";

$pid = $_GET['post_id'];
$delete_status = 0;

if($_SESSION['role'] != 'admin') {

  echo "<center>Sorry, you don't have permission to edit this post!</center>";
  
  } else {

if($_SERVER['REQUEST_METHOD'] == 'POST'){

$confirm = $_POST['confirmation'];

if ($confirm == 'yes') {

    $sql = "DELETE FROM posts WHERE post_id = '$pid'";
 
 if ($conn->query($sql) === TRUE) {
    $delete_status = 1;
    echo "<center>Selected post has been deleted succcesfully. Please visit the dashboard <br><br><a href='".$root."/admin/dashboard.php'><button>Go To  Dashboard!</button></a></center>";
 } else {
   echo "Error deleting record: " . $conn->error;
 }
 

 }
}
  }

if(!$delete_status && $_SESSION['role'] == 'admin'){
?>
<center>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"].'?post_id='.$pid);?>">
<label for="">Type "yes" and submit to confirm the deletion!</label>
<input type="text" name="confirmation">
<input type="submit" value="Delete Post">
</form>
</center>
<?php
}
?>

<?php include "../footer.php";?>