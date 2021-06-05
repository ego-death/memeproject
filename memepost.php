<?php
include('./partials/header.php');
include_once('./includes/db.inc.php');
if (isset($_POST['submit'])) {
  echo '<pre>';
  var_dump($_POST);
  var_dump($_SESSION);
  echo '</pre>';
  $userid = $_SESSION['userid'];
  $imageurl = $_POST['imageUrl'];
  $caption = $_POST['memeCaption'];
  $sql = 'INSERT INTO memes (userid, url, caption) VALUES (?,?,?);';
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    die('stmt could not be prepared');
  }
  mysqli_stmt_bind_param($stmt, "iss", $userid, $imageurl, $caption);
  mysqli_stmt_execute($stmt);
}
$sql = 'SELECT * FROM memes;';
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
  die('stmt could not be prepared');
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<div class="container">
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="formFile" class="form-label">Upload your meme here. The submit button will only show up once an image is uploaded!</label>
      <input class="form-control" type="file" name="image" id="file-upload">
      <input class="hidden" type="text" value="bruh" name="imageUrl" id="imageUrlInput">
    </div>
    <div class="mb-3">
      <label for="formFile" class="form-label">Enter a caption for your post</label>
      <input class="" type="text" value="" name="memeCaption" id="memeCaption" placeholder="Caption..">
    </div>
    <button class="btn btn-secondary hidden" type="submit" name="submit" id="submitbtn">Upload</button>
  </form>
  <h1>Recent Posts: </h1>

  <?php while($resultArray = mysqli_fetch_assoc($result)) { ?>
    <div class="card w-25" style="margin: 17px auto;color: black;">
      <img class="card-img-top" src="<?php echo $resultArray['url']?>" alt="Card image">
      <div class="card-body">
        <h4 class="card-title">USER_ID: <?php echo $resultArray['userid'] ?></h4>
        <p class="card-text"><?php echo $resultArray['caption'] ?></p>
      </div>
    </div>
  <?php } ?>

</div>

<?php include('./partials/footer.php'); ?>