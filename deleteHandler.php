<?php
require_once('database.php');

$ID = $_POST['id'];

try{
    $sql = "DELETE FROM listing WHERE listingID=:id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id',$ID);
    // Prepare statement
    // execute the query
    $stmt->execute();
    // echo a message to say the UPDATE succeeded
    $result =  "Post Deleted successfully";
    echo "Post Deleted successfully";
    header('location:mainPage.php');

}
catch(PDOException $e)
{
    $result= $sql . "<br>" . $e->getMessage();
}


?>