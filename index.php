<?php include('./partials/header.php');
    echo '<pre>';
    var_dump ($_SESSION);
    echo '</pre>';
    echo "random stuff";
    echo "another random thing";
?>

<div class="container">
    <h1 class="title">MEME TRACKER</h1>
    <?php if(isset($_GET['msg'])) { ?>
        <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
    <?php } ?>
</div>

<?php include('./partials/footer.php'); ?>