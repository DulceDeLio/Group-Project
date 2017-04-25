<?php
require_once('database.php');

$ID = $_POST['id'];

try{
    $sql = "DELETE FROM admincheck WHERE listingID=:id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id',$ID);
    $stmt->execute();
    $result =  "Post Deleted successfully";
    echo "Post Deleted successfully";
    header('location:adminPage.php');

}
catch(PDOException $e)
{
    $result= $sql . "<br>" . $e->getMessage();
}


?>