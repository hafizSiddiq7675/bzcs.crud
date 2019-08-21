<?php
require_once '../../private/initialize.php';
$id         = $_POST['id'];
$coa_name   = $_POST['coa_name'];
$coa_desc   = $_POST['coa_desc'];
$coa_type   = $_POST['coa_type'];
$parent_id  = $_POST['parent_id'];
$is_parent  = 0;
$errors     = [];
if($parent_id == 0) {
    $is_parent = 1;
}
if(empty($coa_name)) {
    $errors['coa_name'] = "Chart of Account Name Can not be empty";
}
if(empty($coa_desc)) {
    $errors['coa_desc'] = "Chart of Account Description can not be empty";
}
if($id == '')
{
    if(count($errors) > 0) {
        $_SESSION['coa_errors'] = $errors;
        header('Location: '. BASE_URL . "/pages/coa/create.php");
    }
    else {
        $user_id = $_SESSION['user_id']; 
        $sql     = "INSERT into chart_of_accounts(user_id,coa_name,coa_desc,coa_type,is_parent,parent_id) VALUES('$user_id','$coa_name','$coa_desc','$coa_type','$is_parent','$parent_id')";
    if($conn->query($sql) === TRUE)
    {
        unset($_SESSION['coa_errors']);
        header('Location: '. BASE_URL . "/pages/coa/index.php");
    }
    else
    {
        $errors['create'] = $conn->error;
        $_SESSION['coa_errors'] = $errors;
        header('Location: '. BASE_URL . "/pages/coa/create.php");
    }
}
}
else
{

}