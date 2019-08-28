<?php
require_once '../../private/initialize.php';
$id         = $_POST['id'];
$coa_id     = $_POST['coa_id'];
$ob_desc    = $_POST['ob_desc'];
$amount     = $_POST['amount'];
$errors     = [];
if(empty($amount)) {
    $errors['amount'] = "Opening Balance amount can not be empty";
}
else{
    if(!is_numeric($amount)) {
        $errors['amount'] = "Amount field can only be numbers";
    }
}
if($id == '')
{
    //Create
    if(count($errors) > 0) {
        $_SESSION['ob_errors'] = $errors;
        header('Location: '. BASE_URL . "/pages/opening_balance/create.php");
    }
    else {
        if(isset($_POST['debit'])) {
            $ob_debit  = $_POST['amount'];
            $ob_credit = 0;
        }
        else {
            $ob_debit  = 0;
            $ob_credit = $_POST['amount'];
        }
        $sql     = "INSERT into opening_balances(coa_id,ob_debit,ob_credit,ob_desc) VALUES('$coa_id','$ob_debit','$ob_credit','$ob_desc')";
    if($conn->query($sql) === TRUE)
    {
        unset($_SESSION['ob_errors']);
        header('Location: '. BASE_URL . "/pages/opening_balance/index.php");
    }
    else
    {
        $errors['create'] = $conn->error;
        $_SESSION['ob_errors'] = $errors;
        header('Location: '. BASE_URL . "/pages/opening_balance/create.php");
    }
}
}
else
{
    // Update
    if(count($errors) > 0) {
        $_SESSION['ob_edit_errors'] = $errors;
        header('Location: '. BASE_URL . "/pages/opening_balance/edit.php?id=".$id);
    }
    else
    {
        if(isset($_POST['debit'])) {
            $ob_debit  = $_POST['amount'];
            $ob_credit = 0;
        }
        else {
            $ob_debit  = 0;
            $ob_credit = $_POST['amount'];
        }
        $sql = "UPDATE opening_balances SET coa_id='$coa_id',ob_desc='$ob_desc',ob_debit='$ob_debit',ob_credit='$ob_credit' WHERE id = $id";
        if($conn->query($sql) === TRUE)
        {
            unset($_SESSION['ob_edit_errors']);
            header('Location: '. BASE_URL . "/pages/opening_balance/index.php");
        }
        else
        {
            $errors['edit']       = $conn->error;
            $_SESSION['ob_edit_errors'] = $errors;
            header('Location: '. BASE_URL . "/pages/opening_balance/edit.php?id=".$id);
        }
    }
}