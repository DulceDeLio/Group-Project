
<?php
require_once('database.php');

$ID = $_POST['id'];

try{
    $sql = "DELETE FROM user WHERE userID=:id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id',$ID);
    $stmt->execute();
    $result =  "User Deleted successfully";
    echo $result;
    header('location:users.php');

}
catch(PDOException $e)
{
    $result= $sql . "<br>" . $e->getMessage();
}


?>