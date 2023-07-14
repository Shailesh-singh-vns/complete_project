<?php include '../header.php'; ?>

<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}
?>
<center>
<h1>Welcome to dashboard!</h1>
<?php echo $_SESSION['role'];?>
<a href='<?php echo $root; ?>/admin/add_post.php'><button>Add New Post</button></a><br><br>

<?php
include '../db_connect.php';

// define how many post per page you want to show
$post_per_page = 3;

// get the page number to show
if (!isset($_GET['page'])) {
      $page_number = "1";
} else {
    $page_number = $_GET['page'];
}

// To identify LIMIT Offset value for sql query
$offset = ($page_number-1)*$post_per_page;

if($page_number>0){

$sql = "SELECT * FROM posts";
$result = $conn->query($sql);

$number_of_posts = $result->num_rows;
$number_of_pages = ceil($number_of_posts/$post_per_page);

$sql = "SELECT * FROM posts ORDER BY post_id DESC LIMIT $post_per_page OFFSET $offset";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "<div>
      <h4> ".$row['post_title']."</h4><a href='".$root."/post.php?post_id=".$row['post_id']."'>View</a>
      <a href='".$root."/admin/edit_post.php?post_id=".$row['post_id']."'>Edit</a>
      <a href='".$root."/admin/delete_post.php?post_id=".$row['post_id']."'>Delete</a>
      </div> <br><hr width='50%'><br>";
    }
  } else {
    echo "No Post found!";
  }

switch ($page_number) {
  case 1:
    echo "Previou <a href='".$root."/admin/dashboard.php?page=".($page_number+1)."'>Next</a>";
    break;

    case $number_of_pages:
      echo "<a href='".$root."/admin/dashboard.php?page=".($page_number-1)."'>Previou</a> Next";
      break;
  
  default:
  echo "<a href='".$root."/admin/dashboard.php?page=".($page_number-1)."'>Previou</a>
  <a href='".$root."/admin/dashboard.php?page=".($page_number+1)."'>Next</a>";
    break;
}

}

?>
</center>


<?php include '../footer.php'; ?>