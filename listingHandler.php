<?php
session_start();
if( !isset($_SESSION['logged_in']) ){
    die( "Login required." );

}

include('database.php');

$target_dir = "MyUploadImages/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        $_SESSION['image'] = $target_file;
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}


$subject = $_POST['Category'];
$title = $_POST['title'];
$author = $_POST['author'];
$price = $_POST['price'];
$isbn = $_POST['isbn'];
$zip = $_POST['zip'];
$description = $_POST['description'];
$condition = $_POST['condition'];
$contact = $_POST['contact'];
$file = $_SESSION['image'];
$email = $_POST['email'];

echo $subject;
echo $title;
echo $author;
echo $price;
echo $isbn;
echo $zip;
echo $description;
echo $condition;
echo $contact;
echo $file;
echo $email;

$stmt = $db->prepare("INSERT INTO admincheck (department, title, author, price, isbn, zip, description, status, contact, image, user) VALUES (:subject, :title, :author, :price, :isbn, :zip, :description, :condition, :contact, :file, :user)");
$stmt->bindParam(':subject', $subject);
$stmt->bindParam(':title', $title);
$stmt->bindParam(':author', $author);
$stmt->bindParam(':price', $price);
$stmt->bindParam(':isbn', $isbn);
$stmt->bindParam(':zip', $zip);
$stmt->bindParam(':description', $description);
$stmt->bindParam(':condition', $condition);
$stmt->bindParam(':contact', $contact);
$stmt->bindParam(':file', $file);
$stmt->bindParam(':user', $email);
$stmt->execute();

echo "<br>Successfully entered into the database<br>";
echo "<a href=".header('location:mainPage.php')."Go Back</a>";
?>

