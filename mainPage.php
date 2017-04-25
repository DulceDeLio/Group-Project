<?php
session_start();
if( !isset($_SESSION['logged_in']) ){
    die( "Login required." );
}


include('database.php');
$email = $_SESSION['email'];
$sql2 = "SELECT * FROM department";
$stmt2 = $db->prepare($sql2);
$stmt2->execute();
$department = $stmt2->fetchAll();

echo "Today is " . date("m/d") . "<br>";
echo "Hello, ".$_SESSION['first']." ".$_SESSION['last'];

if (isset($_GET['min'])){
    $min = $_GET['min'];
    }
    else
    {
        $min = NULL;
    }
///////////////////////////////
if (isset($_GET['max'])){
    $max = $_GET['max'];
    }
    else
    {
      $max = NULL;
    }
//////////////////////////////////
if (isset($_GET['condition'])){
    $condition = $_GET['condition'];
    }
    else
    {
        $condition = NULL;
    }
//////////////////////////////////
if (isset($_GET['zip'])){
    $zip = $_GET['zip'];
    }
    else
    {
        $zip = NULL;
    }
///////////////////////////////////
if (isset($_GET['category'])){
    $category = $_GET['category'];
    }
    else
    {
     $category = NULL;
    }
///////////////////////////////////
if (isset($_GET['view'])){
    $view = $_GET['view'];
}
else
{
    $view = NULL;
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

<form action="post.php" method="post">
        <input class="button" type = "submit" value="Post" onClick="location.href='post.php'" title="Post"/>
        <input type='hidden' value=<?php echo $email ?> name='email' >

</form>


<form action="filters.php" method="post">
    <select name="Category" selected="Categories">
        <option selected="selected">Categories</option>
        <?php foreach($department as $departments){ ?><option value="<?php echo $departments['name'];?>"><?php echo($departments['name']); }?></option></select>


    <select name="view">
        <option value="view">View</option>
        <option value="list">List</option>
        <option value="pic">Pictures</option>
    </select>
        </div>

         <div class="div2">
        <u>Price:</u>
             <br>
             <input type = "text" value ="min" name = "min">    <br>
             <input type = "text" value ="max" name = "max">    <br>

         <u>Condition</u>
             <br>
             <input type="radio" name="condition" value="new">New<br>
             <input type="radio" name="condition" value="used">Used<br>


             <input type="submit" value="Apply Filters">
             <input type='hidden' value=<?php echo $email ?> name='email' >

         </div>
</form>

<b><u>MOST RECENT POSTS</u></b><br>



<?php
     $line = "SELECT * FROM listing";

     $first = TRUE;
     if ($category != 'Categories' && $category != NULL) {
         if ($first) {
             $first = FALSE;
             $line = $line . " WHERE";
         } else {
             $line = $line . " AND ";
         }
         $line = $line . " department = '" . $category . "'";
     }

     if ($condition != "") {
         if ($first) {
             $first = FALSE;
             $line = $line . " WHERE";
         } else {
             $line = $line . " AND ";
         }
         $line = $line . " status = '" . $condition . "'";
     }

    if(($min != 'min' && $max == 'max') && ($min != NULL && $max != NULL)){
        if ($first) {
            $first = FALSE;
            $line = $line . " WHERE";
        } else {
            $line = $line . " AND ";
        }
        $line = $line . " price >= '" . $min . "'";
    }

    if(($max != 'max' && $min == 'min') && ($min != NULL && $max != NULL)){
        if ($first) {
            $first = FALSE;
            $line = $line . " WHERE";
        } else {
            $line = $line . " AND ";
        }
        $line = $line . " price <= '" . $max . "'";
    }

    if(($max != 'max' && $min != 'min') && ($min != NULL && $max != NULL)){
        if ($first) {
            $first = FALSE;
            $line = $line . " WHERE";
        } else {
            $line = $line . " AND ";
        }
        $line = $line . " price <= '" . $max . "'" . " AND " . " price >= '" . $min . "'";
    }

    if($min == 'min' && $max == 'max' && $condition == '' && $zip == '' && $category == 'Categories')
    {
     $line = "SELECT * FROM listing ORDER BY listingID DESC";
    }

    if($line == "SELECT * FROM listing")
    {
        $line = $line . " ORDER BY listingID DESC ";
    }

     $stmt = $db->prepare($line);
     $stmt->execute();
     $listing = $stmt->fetchAll();

?>

    <?php foreach ($listing as $listings) : ?>

        <a href="listing.php?ID=<?php echo $listings['listingID']; ?>">
                <?php echo $listings['title']; ?> </a> <?php echo '$'. $listings['price'];?><br>
    <?php endforeach; ?>


        <b><u>YOUR POSTS</u></b><br>
<?php
$sq3 = "SELECT * FROM listing WHERE user = :user";
$stmt3 = $db->prepare($sq3);
$stmt3->bindValue(':user', $email);
$stmt3->execute();
$yours = $stmt3->fetchAll();
?>
<?php foreach ($yours as $you) : ?>

    <a href="listing.php?ID=<?php echo $you['listingID']; ?>">
        <?php echo $you['title']; ?> </a> <?php echo '$'. $you['price'];?><br>
<?php endforeach; ?>

<input type="button" value="Sign Out" id="btnout"
       onClick="document.location.href='logout.php'" />
</body>
</html>




