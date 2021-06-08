<?php include_once('./partials/header.php');
include_once('./includes/db.inc.php');
$id = $_GET['id'];
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = 'SELECT * FROM memes WHERE id=?;';
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        die('stmt was not able to be prepared');
    }
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
}
if(isset($_POST['submit'])) {
    $uid = $_SESSION['userid'];
    $postid = $_GET['id'];
    $comment = $_POST['comment'];
    $sql = 'INSERT INTO comments (uid, postid, comment) VALUES (?,?,?);';
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        die('stmt was not able to be prepared');
    }
    mysqli_stmt_bind_param($stmt, "sss", $uid, $postid, $comment);
    mysqli_stmt_execute($stmt);
    }
    $sql = 'SELECT * FROM comments where postid=?;';
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        die('stmt was not able to be prepared');
    }
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
?>

<div class="container">
<img src="<?php echo $row['url']?>" class="rounded mx-auto d-block" alt="" style="border:5px solid black;margin-top:30px;width:500px;height:400px">
<h1 style="margin-top: 10px;text-align: center;"><?php echo $row['caption'] ?></h1>
<form action="" method="post">
<div class="mb-3">
      <input class="form-control w-25" type="text" name="comment" placeholder="Add a comment!" style="margin: 0 auto;">
</div>
<div class="mb-3">
      <input class="form-control" type="submit" name="submit" value="Submit" style="margin: 0 auto; width: 100px">
</div>
</form>
<h2 style="margin-top: 10px;text-align: center;">Comments:</h2>
<?php while($row = mysqli_fetch_assoc($result)) { ?>
<h4>'<?php echo $row['comment'] ?>' - user-id: <?php echo $row['uid'] ?></h4>
<?php } ?>
</div>

<?php include_once('./partials/footer.php') ?> 