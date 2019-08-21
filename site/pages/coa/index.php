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
$sql        = "SELECT * from chart_of_accounts WHERE user_id = " . $user_id;
$result     = $conn->query($sql);
if ($result->num_rows > 0) {
    $coa = $result->fetch_all(MYSQLI_ASSOC);
}
else {
    $coa = array();
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
    <a href="<?php echo BASE_URL ?>/pages/coa/create.php" target="_blank"><button class="btn btn-primary">Create New</button></a>
    <hr>
                <table id="data" class="table table-bordered">
                    <thead>
                        <tr>
                            <td>
                                ID
                            </td>
                            <td>
                                Name
                            </td>
                            <td>
                                Description
                            </td>
                            <td>
                                Type
                            </td>
                            <td>
                                Is Parent?
                            </td>
                            <td>
                                Parent
                            </td>
                            <td>
                                Action
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($coa as $key => $item)
                         {
                            $is_parent = '';
                            if ($item['is_parent']) {
                                $is_parent = "Yes";
                            } else {
                                $is_parent = "No";
                            }
                            $parent = '';
                            if ($item['parent_id'] != 0) {
                                $id      = $item['parent_id'];
                                $sql     = "SELECT * from chart_of_accounts where id = " . $id;
                                $result  = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    $account = $result->fetch_assoc();
                                    $parent  = $account['coa_name'];
                                }
                            }
                            else
                            {
                                $parent = "NA";
                            }
                            echo '<tr>' . PHP_EOL;
                            echo '<td>' . h($item['id']) . '</td>' . PHP_EOL;
                            echo '<td>' . h($item['coa_name']) . '</td>' . PHP_EOL;
                            echo '<td>' . h($item['coa_desc']) . '</td>' . PHP_EOL;
                            echo '<td>' . h($item['coa_type']) . '</td>' . PHP_EOL;
                            echo '<td>' . h($is_parent) . '</td>' . PHP_EOL;
                            echo '<td>' . h($parent) . '</td>' . PHP_EOL;
                            echo '<td>Action</td>' . PHP_EOL;
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="../../_js/popper.min.js"></script>
    <script src="../../_js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            let table = $('#data').DataTable();
        });
    </script>
</body>
</html>