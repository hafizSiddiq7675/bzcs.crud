<?php
require_once '../../../private/initialize.php';
if (!isset($_SESSION['user_id'])) {
    echo '<pre>';
    print_r("Unauthorized");
    exit;
}
$id = $_POST['id'];
if($id != '')
{
    $sql = "SELECT * from chart_of_accounts where id = $id";
    $result     = $conn->query($sql);
    if ($result->num_rows > 0) {
    $coa_delete = $result->fetch_assoc();
    }
    if($coa_delete['is_parent'] == true) {
     $sql = "DELETE from chart_of_accounts WHERE parent_id = $id";
     $conn->query($sql);   
    }
    $sql = "DELETE from chart_of_accounts WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        $result = array('success' => true,'error' => '');
    } else {
        $result = array('success' => false, 'error' => $conn->error);
    }
}
else
{
    $result = array('success' => false, 'error' => 'No id field passed');
}
echo json_encode($result);