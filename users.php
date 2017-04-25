<?php
session_start();
include('database.php');

$u = "Admin";
if($_SESSION['role'] != $u){
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

<h1>Admin Control Panel</h1>
<h3>Users </h3>

<?php
$role = "User";
$queryUser = "SELECT * FROM `user`  WHERE role = :role";
$statement = $db->prepare($queryUser);
$statement->bindValue(':role', $role);
$statement->execute();
$users = $statement->fetchAll();
?>
<table>
    <thead>
    <tr>
        <th>User</th>
        <th>Email</th>
        <th>Delete</th>
        <th> </th>
    </tr>
    </thead>
    <tbody>

    <?php
    foreach ($users as $user) { ?>
    <tr>
        <td><?php echo $user['userID'];?></td>
        <td><?php echo $user['email'];?></td>
        <form action='deleteUser.php' method='post'>
            <td><input type="image" src="img/delete.png" alt="Submit" width="30"></td>
            <input type='hidden' value='<?php echo  $user['userID']?>' name='ID' >
        </form>

        <?php } ?>
    </tr>

    </tbody>
</table>


<input class="button" type = "submit" value="Back" onClick="location.href='adminPage.php'" title="Back"/>

</body>
</html>



