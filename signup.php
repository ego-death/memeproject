<?php include('./partials/header.php');
?>

<div class="container">
<h1 class="title">SIGN UP</h1>
<?php if($_GET) { ?>
<div class="alert alert-danger" role="alert">
<?php echo $_GET['error']; ?>
</div>
<?php } ?>
<form action="./includes/signup.inc.php" method="post">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Email...">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name="username" placeholder="Username...">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password...">
  </div>
  <div class="mb-3">
    <label for="passwordRepeat" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="passwordRepeat" placeholder="Repeat Password...">
  </div>
  <button type="submit" class="btn btn-primary">Sign Up</button>
</form>
</div>



<?php include('./partials/footer.php'); ?>
