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
    //Update
    // if(count($errors) > 0) {
    //     $_SESSION['edit_coa_errors'] = $errors;
    //     header('Location: '. BASE_URL . "/pages/coa/edit.php?id=".$id);
    // }
    // else
    // {
    //     $sql = "UPDATE chart_of_accounts SET coa_name='$coa_name',coa_desc='$coa_desc',coa_type='$coa_type',is_parent='$is_parent',parent_id='$parent_id' WHERE id = $id";
    //     if($conn->query($sql) === TRUE)
    //     {
    //         unset($_SESSION['edit_coa_errors']);
    //         header('Location: '. BASE_URL . "/pages/coa/index.php");
    //     }
    //     else
    //     {
    //         $errors['create']       = $conn->error;
    //         $_SESSION['edit_coa_errors'] = $errors;
    //         header('Location: '. BASE_URL . "/pages/coa/edit.php?id=".$id);
    //     }
    // }
}