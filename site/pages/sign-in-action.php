<?php
require_once '../private/initialize.php';
$email       = $_POST['email'];
$password    = $_POST['password'];
$errors = [];
if(empty($email))
{
    $errors['email'] = "Email field can not be blank";
}

if(empty($password))
{
    $errors['password'] = "Password field can not be blank";
}

if(count($errors) > 0) 
{
    $_SESSION['errors'] = $errors;
    header('Location: '. BASE_URL . "/pages/sign-in.php");
}
else
{
    $password = md5($password);
    $sql = "SELECT * from users where email = '$email' AND password='$password'";
    $result  = $conn->query($sql);
    if($result->num_rows > 0)
    {
        $user                   = $result->fetch_assoc();
        $_SESSION['user_id']    = $user['id'];
        $base_url               = BASE_URL;
        $base_url               = str_replace('site','',$base_url);
        header('Location: '. $base_url);
    }
    else
    {
        $errors['invalid'] = "Invalid Credential provided";
        $_SESSION['errors'] = $errors;
        header('Location: '. BASE_URL . "/pages/sign-in.php");
    }
}