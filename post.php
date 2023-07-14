<?php include 'header.php'; ?>
<center>  
<?php
include 'db_connect.php';

$post_id = $_GET['post_id'];

$sql = "SELECT * FROM posts WHERE post_id = '$post_id'";
$result = $conn->query($sql);



if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "<div>
      <h2>".$row['post_title']." </h2>
      <div>".$row['post_content']."</div> 
      </div> <br> <br><hr width='50%'><br><br>";
    }
  } else {
    echo "Post not found!";
  }
 
?>
</center>

<?php include 'footer.php'; ?> 
