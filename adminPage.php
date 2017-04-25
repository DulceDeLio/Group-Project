<?php
session_start();
include('database.php');

$user = "Admin";
if($_SESSION['role'] != $user){
    header('location:index.html');
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Niner BookXChange</title>
    <link rel="stylesheet" type="text/css" href="css/main.css" />
</head>
<body>

<form action="users.php" method="post">
    <input class="button" type = "submit" value="User Panel" onClick="location.href='users.php'" title="User Panel"/>

</form>
<h1>Admin Control Pannel</h1>
<?php
$sq3 = "SELECT * FROM admincheck";
$stmt3 = $db->prepare($sq3);
$stmt3->execute();
$listing = $stmt3->fetchAll();

?>
<?php foreach ($listing as $list) :  ?>

    <a href="AdminListingHandler.php?ID=<?php echo $list['listingID']; ?>">
        <?php echo $list['title']; ?> </a> <?php echo '$'. $list['price'];?><br>
<?php endforeach; ?>

<input type="button" value="Sign Out" id="btnout"
       onClick="document.location.href='logout.php'" />
</body>
</html>


