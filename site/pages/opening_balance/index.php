<?php require_once '../../private/initialize.php';
if (!isset($_SESSION['user_id'])) {
    echo '<pre>';
    print_r("Unauthorized");
    exit;
}

$user_id = $_SESSION['user_id'];
$sql     = "SELECT * from users where id = " . $user_id;
$result  = $conn->query($sql);
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
}
$sql        = "SELECT * from opening_balances";
$result     = $conn->query($sql);
if ($result->num_rows > 0) {
    $opening_balance = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $opening_balance = array();
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
        <a href="<?php echo BASE_URL ?>/pages/opening_balance/create.php" target="_blank"><button class="btn btn-primary">Create New</button></a>
        <hr>
        <table id="data" class="table table-bordered">
            <thead>
                <tr>
                    <td>
                        ID
                    </td>
                    <td>
                       Account Name
                    </td>
                    <td>
                        Description
                    </td>
                    <td>
                        Debit
                    </td>
                    <td>
                        Credit
                    </td>
                    <td>
                        Action
                    </td>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($opening_balance as $key => $item) {
                    $account_name = '';
                    if ($item['coa_id'] != '') {
                        $id      = $item['coa_id'];
                        $sql     = "SELECT * from chart_of_accounts where id = " . $id;
                        $result  = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $account = $result->fetch_assoc();
                            $acount_name  = $account['coa_name'];
                        }
                    }
                    echo '<tr>' . PHP_EOL;
                    echo '<td>' . h($item['id']) . '</td>' . PHP_EOL;
                    echo '<td>' . h($acount_name) . '</td>' . PHP_EOL;
                    echo '<td>' . h($item['ob_desc']) . '</td>' . PHP_EOL;
                    echo '<td>' . h($item['ob_debit']) . '</td>' . PHP_EOL;
                    echo '<td>' . h($item['ob_credit']) . '</td>' . PHP_EOL;
                    echo '<td><a href="' . BASE_URL . '/pages/opening_balance/edit.php?id=' . $item['id'] . '"<button class="btn btn-success">Edit</button></a> <a href="javascript:;"<button class="btn btn-danger delete" data-id=' . $item['id'] . '>Delete</button></a></td>' . PHP_EOL;
                    echo '</tr>' . PHP_EOL;
                }
                ?>
            </tbody>
        </table>
    </main>
    <?php include('../../private/shared/footer.php') ?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.3.2/bootbox.js"></script>
    <script src="../../_js/popper.min.js"></script>
    <script src="../../_js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            let table = $('#data').DataTable();
            $('.delete').on('click', function() {
                let id = $(this).data('id');
                bootbox.confirm("Are you sure! This item will be deleted permanently", function(result) {
                    if (result) {
                        $.post(
                                'ajax_php/delete_ob.php', {
                                    id: id
                                }
                            )
                            .fail(function(requestedObject, error, thrownError) {
                                console.error(thrownError);
                            }).done(function(data) {
                                let info = JSON.parse(data);
                                if (info['success'] === true) {
                                    location.reload();
                                } else {
                                    bootbox.alert("ERROR Deleting Record: " + info['error']);
                                }
                            })
                    }
                });
            });
        });
    </script>
</body>

</html>