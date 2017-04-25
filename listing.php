<?php
session_start();
if( !isset($_SESSION['logged_in']) )
    die( "Login required." );
include('database.php');

$ID = $_GET['ID'];

$sql = "SELECT * FROM listing WHERE listingID='".$ID."'";
$stmt = $db->prepare($sql);
$stmt->execute();
$listing = $stmt->fetchAll();
$email = $_SESSION['email'];

foreach ($listing as $listings){
    echo '<img src="'.$listings['image'].'" width="500" height="500"><br>';

    echo "Department: ".$listings['department']."<br>";
    echo "Title: " .$listings['title']."<br>";
    echo "Author: ".$listings['author']."<br>";
    echo "ISBN #: ".$listings['isbn']."<br>";
    echo "Status: ".$listings['status']."<br>";
    echo "Description: ".$listings['description']."<br>";
    echo "Contact Information: ".$listings['contact']."<br>";

    if($listings['user']==$email){ ?>
        <form action='deleteHandler.php' method='post'>
            <input type='submit' value='Delete Post' />
            <input type='hidden' value=<?php echo $ID?> name='id' >
        </form>

        <?php
    }
}
?>


<form action="mainPage.php" method="post">

    <input class="button" type = "submit" value="Back" onClick="location.href='mainPage.php'" title="Back"/>
</form>
