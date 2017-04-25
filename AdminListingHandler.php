<?php
session_start();
if( !isset($_SESSION['logged_in']) )
    die( "Login required." );
include('database.php');
$u = "Admin";
if($_SESSION['role'] != $u){
    header('location:index.html');
}

$ID = $_GET['ID'];

$sql = "SELECT * FROM admincheck WHERE listingID='".$ID."'";
$stmt = $db->prepare($sql);
$stmt->execute();
$listing = $stmt->fetchAll();

foreach ($listing as $listings){
    echo '<img src="'.$listings['image'].'" width="500" height="500"><br>';

    echo "Department: ".$listings['department']."<br>";
    echo "Title: " .$listings['title']."<br>";
    echo "Author: ".$listings['author']."<br>";
    echo "ISBN #: ".$listings['isbn']."<br>";
    echo "Status: ".$listings['status']."<br>";
    echo "Description: ".$listings['description']."<br>";
    echo "Contact Information: ".$listings['contact']."<br>";
    ?>
    <form action='AdminDeleteHandler.php' method='post'>
        <input type='submit' value='Delete Post' />
        <input type='hidden' value="<?php echo $ID; ?>" name='id' >
    </form>
    <form action='AdminApproveHandler.php' method='post'>
        <input type='submit' value='Approve Post' />
        <input type='hidden' value="<?php echo $ID; ?>" name='id'>
        <input type='hidden' value="<?php echo $listings['department']; ?>" name='Category'>
        <input type='hidden' value="<?php echo $listings['title']; ?>" name='title'>
        <input type='hidden' value="<?php echo $listings['author']; ?>" name='author'>
        <input type='hidden' value="<?php echo $listings['price']; ?>" name='price'>
        <input type='hidden' value="<?php echo $listings['isbn']; ?>" name='isbn'>
        <input type='hidden' value="<?php echo $listings['zip']; ?>" name='zip'>
        <input type='hidden' value="<?php echo $listings['description']; ?>" name='description'>
        <input type='hidden' value="<?php echo $listings['status']; ?>" name='condition'>
        <input type='hidden' value="<?php echo $listings['contact']; ?>" name='contact'>
        <input type='hidden' value="<?php echo $listings['image']; ?>" name='image'>
        <input type='hidden' value="<?php echo $listings['user']; ?>" name='email'>
    </form>


    <?php
}
?>



<br><br><br>
<form action="adminPage.php" method="post">

    <input class="button" type = "submit" value="Back" onClick="location.href='adminPage.php' title="Back"/>
</form>
