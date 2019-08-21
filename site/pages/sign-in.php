
<?php require_once '../private/initialize.php' ?>
<!doctype html>
<html lang="en">
  <?php include('../private/shared/sign-header.php') ?>
  <body class="text-center">

    <form class="form-signin" method="post" action="sign-in-action.php">
    <?php if(isset($_SESSION['errors-signIn']))
  foreach ($_SESSION['errors-signIn'] as $key => $value) {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>PLEASE FIX!</strong> ' .$value.'
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div> ';
  }
  ?>
      <img class="mb-4" src="../_img/logo.png" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign In</h1>
      <label for="email" class="sr-only">Email address</label>
      <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required autofocus>
      <label for="password" class="sr-only">Password</label>
      <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign In</button>
      <p class="mt-5 mb-3 text-muted">&copy; <?php echo date('Y') ?></p>
    </form>
    <?php include('../private/shared/footer.php') ?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="<?php echo BASE_URL?>/_js/popper.min.js" type = text/javascript></script>
    <script src="<?php echo BASE_URL?>/_js/bootstrap.min.js" type = text/javascript></script>
  </body>
</html>
