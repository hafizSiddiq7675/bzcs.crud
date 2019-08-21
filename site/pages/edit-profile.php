
<?php require_once '../private/initialize.php';
if(!isset($_SESSION['user_id']))
{
  echo '<pre>'; print_r("Unauthorized"); exit;
}
$user_id = $_SESSION['user_id'];
$sql     = "SELECT * from users where id = " .$user_id;
$result  = $conn->query($sql);
    if($result->num_rows > 0)
    {
      $user = $result->fetch_assoc();
    }
?>
<!doctype html>
<html lang="en">
  <?php include('../private/shared/sign-header.php') ?>
  <body class="text-center">

    <form class="form-signin" method="post" action="edit-profile-action.php">
    <?php if(isset($_SESSION['errors-editProfile']))
  foreach ($_SESSION['errors-editProfile'] as $key => $value) {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>PLEASE FIX!</strong> ' .$value.'
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div> ';
  }
  ?>
    <input type="hidden" name="id" value="<?php echo $user['id']?>">
      <img class="mb-4" src="../_img/logo.png" alt="" width="72" height="72">
      <label for="name" class="sr-only">Your Full Name</label>
      <input type="text" id="name" name="name" class="form-control" value="<?php echo $user['name']?>" placeholder="Your Full Name" required autofocus>
      <label for="email" class="sr-only">Email address</label>
      <input type="email" id="email" name="email" class="form-control" value="<?php echo $user['email']?>" placeholder="Email address" required autofocus>
      <label for="password" class="sr-only">Password</label>
      <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
      <label for="confirmPassword" class="sr-only">Confirm Password</label>
      <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Confirm Password" required>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Update</button>
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
