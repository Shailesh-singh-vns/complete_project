<?php
require "../db_connect.php";
include "../header.php";

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}
?>


<?php
$post_title = $post_content = "";
$post_title_err = $post_content_err = "";
$update_post_status = 0;
$pid = "";

if($_SESSION['role'] != 'admin') {

echo "<center>Sorry, you don't have permission to edit this post!</center>";

} else {

function secure_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}



if(isset($_GET)){
$pid = $_GET['post_id'];

$sql = "SELECT * FROM posts WHERE post_id = '$pid'";
$result = $conn->query($sql);

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $post_title = $row['post_title'];
        $post_content = $row['post_content'];
    }
} else{
    echo "Oops, something went wrong!";
}

}

if($_SERVER['REQUEST_METHOD'] == "POST") {

if(empty($_POST['post_title'])){
 $post_title_err = "Post title is required!";

} else {
    $post_title = secure_input($_POST['post_title']);
}

if(empty($_POST['post_content'])){
    $post_content_err = "Post content is required!";
   
   } else {
       $post_content = secure_input($_POST['post_content']);
   }

if (!empty($post_title) && !empty($post_content) && !empty($_SESSION['user_id'])) {

    $user_id = $_SESSION['user_id'];
    $sql = "UPDATE posts SET post_title = '$post_title', post_content = '$post_content', user_id = '$user_id' WHERE post_id = '$pid'";
    
    if ($conn->query($sql) === TRUE) {
       $update_post_status = 1;
       echo "<center>Post has been updated succcesfully. Please visit the dashboard <br><br><a href='".$root."/admin/dashboard.php'><button>Go To  Dashboard!</button></a></center>";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

}
}

?>
<?php
if(!$update_post_status  && $_SESSION['role'] == 'admin'){
?>
<center>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?post_id=".$pid; ?>" method="POST">
<label for="">Post Title: </label><br><br>
<input type="text" name="post_title" cols="30" value="<?php echo $post_title;?>"><br><?php echo  $post_title_err;?><br><br>

<label for="">Post Content: </label><br><br>
<textarea name="post_content"  cols="30" rows="10"><?php echo $post_content;?></textarea><br><?php echo  $post_content_err;?><br><br>
<input type="submit" value="Update Post">

</form>
</center>
<?php
}
?>


<?php include "../footer.php";?>