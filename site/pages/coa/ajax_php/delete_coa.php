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