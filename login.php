<?php include('./partials/header.php'); ?>

<div class="container">
<h1 class="title">LOGIN</h1>
<form action="./includes/login.inc.php" method="post">
  <div class="mt-5 mb-3 w-100">
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Username/Email...">
  </div>
  <div class="mb-3 w-100">
    <input type="password" class="form-control" id="password" name="password" placeholder="Password...">
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Sign In</button>
</form>
</div>



<?php include('./partials/footer.php'); ?>
