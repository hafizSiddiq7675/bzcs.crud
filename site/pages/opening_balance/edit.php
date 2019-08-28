<?php require_once '../../private/initialize.php';
if (!isset($_SESSION['user_id'])) {
    echo '<pre>';
    print_r("Unauthorized");
    exit;
}
$id         = $_GET['id'];
$user_id    = $_SESSION['user_id'];
$sql        = "SELECT * from users where id = " .$user_id;
$result     = $conn->query($sql);
    if($result->num_rows > 0)
    {
      $user = $result->fetch_assoc();
    }
    if($id != '') {
        $sql    = "SELECT * from opening_balances where id = $id";
        $result = $conn->query($sql);
        if($result->num_rows > 0) {
            $ob_edit = $result->fetch_assoc();
        }
    }    
$sql        = "SELECT chart_of_accounts.id, opening_balances.coa_id,chart_of_accounts.coa_name from chart_of_accounts LEFT JOIN opening_balances ON chart_of_accounts.id = opening_balances.coa_id WHERE chart_of_accounts.user_id = " . $user_id . " AND chart_of_accounts.is_parent = 0";
$result     = $conn->query($sql);
if ($result->num_rows > 0) {
    $coa = $result->fetch_all(MYSQLI_ASSOC);
    }
?>
<!doctype html>
<html lang="en">

<?php include('../../private/shared/header.php') ?>

<body>

    <header>
        <!-- Fixed navbar -->
        <?php include('../../private/shared/nav.php') ?>
    </header>

    <!-- Begin page content -->
    <main role="main" class="container">
        <h1>Edit Opening Balance Entry</h1>
        <hr>
        <form method="post" action="<?php echo BASE_URL ?>/pages/opening_balance/ob-action.php">
        <input type="hidden" name="id" value = "<?php echo $ob_edit['id'] ?>">
        <?php if(isset($_SESSION['ob_edit_errors']))
  foreach ($_SESSION['ob_edit_errors'] as $key => $value) {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>PLEASE FIX!</strong> ' .$value.'
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div> ';
  }
  ?>
        <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="coa_id">Select Chart of Account</label>
                        <select class="form-control" id="coa_id" name="coa_id">
                            <?php if(isset($coa)) 
                                foreach ($coa as $key => $value) {
                                    if($value['id'] == $ob_edit['coa_id']) {
                                        echo '<option id="' . $value['id'] . '" value="' . $value['id'] . '" selected="selected">' .
                                        $value['coa_name'] . '</option>';
                                    }
                                    else {
                                        if($value['coa_id'] == '') {
                                            echo '<option id="' . $value['id'] . '" value="' . $value['id'] . '">' .
                                            $value['coa_name'] . '</option>';
                                        }
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                            <label for="amount">Enter Amount</label>
                            <?php if($ob_edit['ob_debit'] != 0): ?>
                                <input type="text" class="form-control" name="amount" id="amount" placeholder="Enter Amount" required value="<?php echo $ob_edit['ob_debit'] ?>">
                            <?php else: ?>
                                <input type="text" class="form-control" name="amount" id="amount" placeholder="Enter Amount" required value="<?php echo $ob_edit['ob_credit'] ?>">
                            <?php endif; ?>    
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                            <label for="ob_desc">Opening Balance Description</label>
                            <input type="text" class="form-control" name="ob_desc" id="ob_desc" placeholder="Enter Opening Balance Description" value="<?php echo $ob_edit['ob_desc'] ?>" >
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success" id="debit" name="debit">Debit</button>
            <button type="submit" class="btn btn-success" id="credit" name="credit">Credit</button>
        </form>
    </main>
    <?php include('../../private/shared/footer.php') ?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="../../_js/popper.min.js"></script>
    <script src="../../_js/bootstrap.min.js"></script>
</body>
</html>