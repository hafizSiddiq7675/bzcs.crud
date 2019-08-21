<?php
require_once '../private/initialize.php';
$name               = $_POST['name'];
$email              = $_POST['email'];
$password           = $_POST['password'];
$confirmPassword    = $_POST['confirmPassword'];
$errors = [];
if(empty($name))
{
    $errors['name'] = "Name field can not be blank";
}
if(empty($email))
{
    $errors['email'] = "Email field can not be blank";
}
else 
{
    $sql    = "SELECT * from users where email = '$email'";
    $result = $conn->query($sql);
    if($result->num_rows > 0)
    {
        $errors['email'] = "Email already exisit";
    }
}

if(empty($password))
{
    $errors['password'] = "Password field can not be blank";
}
if(empty($confirmPassword)) 
{
    $errors['confirmPassword'] = "Confirm Password field can not be blank";
}
if($password != $confirmPassword) 
{
    $errors['password'] = "Password and Confirm Password do not match";
}

if(count($errors) > 0) 
{
    $_SESSION['errors-signUp'] = $errors;
    header('Location: '. BASE_URL . "/pages/sign-up.php");
}
else
{
    $password = md5($password);
    $sql = "INSERT into users(name,email,password) VALUES('$name','$email','$password')";
    if($conn->query($sql) === TRUE)
    {
        $_SESSION['user_id'] = $conn->insert_id;
        $base_url = BASE_URL;
        $base_url = str_replace('site','',$base_url);
        header('Location: '. $base_url);
    }
    else
    {
        $errors['update'] = $conn->error;
        $_SESSION['errors-signUp'] = $errors;
        header('Location: '. BASE_URL . "/pages/sign-up.php");
    }
}