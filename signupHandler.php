<?php


include('database.php');


$error = 0;

$userName = $_POST['username'];
$password = $_POST['password'];
$firstname = $_POST['firstname'];
$email = $_POST['email'];
$lastname = $_POST['lastname'];
$confirmpassword = $_POST['confirmpassword'];
$gender = $_POST['gender'];
$role = "User";


$sql = "SELECT * FROM user";
$stmt = $db->prepare($sql);
$stmt->execute();
$user = $stmt->fetchAll();

foreach($user as $users){
    if($userName == $users['userName']){
       $error = 1;
        header('location:signup.php?error='.$error);
        break;
    }
    if($email == $users['email']){
        $error = 5;
        header('location:signup.php?error='.$error);
        break;
    }
}

if (!preg_match('/^[a-zA-Z0-9]{4,10}$/',$userName))
{
    $error = 2;
    header('location:signup.php?error='.$error);
}

elseif(preg_match('/^(.{0,7}|[^A-Z]*|[a-zA-Z0-9]*)$/', $password))
{
    $error = 3;
    header('location:signup.php?error='.$error);
}

elseif(!preg_match('/^[a-zA-Z]+$/', $firstname))
{
    $error = 8;
    header('location:signup.php?error='.$error);
}

elseif(!preg_match('/^[a-zA-Z]+$/', $lastname))
{
    $error = 8;
    header('location:signup.php?error='.$error);
}

elseif($password != $confirmpassword)
{
    $error = 4;
    header('location:signup.php?error='.$error);
}


elseif($gender != 'male' && $gender != 'female')
{
    $error = 6;
    header('location:signup.php?error='.$error);
}


elseif (!preg_match("/^[a-zA-Z0-9_\-.]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-.]+$/", $email)) {
    $error = 7;
    header('location:signup.php?error='.$error);
}

else {
    $stmt = $db->prepare("INSERT INTO user (userName, email, password, firstName, lastName, gender, Role) VALUES (:username, :email, :password, :firstname, :lastname, :gender, :Role)");
    $stmt->bindParam(':username', $userName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':Role', $role);
    $stmt->execute();
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Registration Handler</title>
    <!-- Framework CSS -->
    <link rel="stylesheet" href="screen.css" type="text/css" media="screen, projection">
    <link rel="stylesheet" href="print.css" type="text/css" media="print">
    <!--[if lt IE 8]><link rel="stylesheet" href="ie.css" type="text/css" media="screen, projection"><![endif]-->
</head>
<body>
<div class="container">
    <h1>Registration Complete</h1>
    <hr>
    <div class="span-3">
        <br/>
    </div>
    <div class="span-18">
        <div class="success">
            User successfully registered. <a href="index.html">Login</a>.
        </div>
    </div>
    <div class="span-3 last">
        <br/>
    </div>
</div>
</body>
</html>