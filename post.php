<?php
session_start();
include('database.php');

$sql = "SELECT * FROM department";
$stmt = $db->prepare($sql);
$stmt->execute();
$department = $stmt->fetchAll();

$email = $_SESSION['email'];
?>
<html>



<form action="listingHandler.php" method="post" enctype="multipart/form-data">

Category/Subject:<input type = "text" value ="Category" name = "Category"><br><br>


Book Title: <input type = "text" value ="Book Title" name = "title"><br><br>

    Author: <input type = "text" value ="Author" name = "author"><br><br>

Price:<input type = "text" value ="Price" name = "price"><br><br>

ISBN #:<input type = "text" value ="ISBN" name = "isbn"><br><br>

    Zip code:<input type = "text" value ="zip" name = "zip"><br><br>Description:<br>

 <textarea name="description" rows="7" cols="40">Add description here.</textarea><br><br>

    Condition: <input type="radio" name="condition" value="new" checked>New <input type="radio" name="condition" value="used">Used <br><br>

Contact: <input type="text" value="contact" name="contact"><br><br>
    User: <?php echo $email; ?><br><br>
    <input type='hidden' value=<?php echo $email ?> name='email' >


    <input type="file" name="fileToUpload" id="fileToUpload">

    <input type="submit" value="Submit">
</form>

</html>