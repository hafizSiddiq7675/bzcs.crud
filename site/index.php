<?php require_once 'private/initialize.php';
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

<?php include('private/shared/header.php') ?>
  <body>

    <header>
      <!-- Fixed navbar -->
      <?php include('private/shared/nav.php') ?>
    </header>

    <!-- Begin page content -->
    <main role="main" class="container">
      <h1 class="mt-5">Main Content</h1>
    </main>
    <?php include('private/shared/footer.php') ?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="_js/popper.min.js"></script>
    <script src="_js/bootstrap.min.js"></script>
  </body>
</html>
