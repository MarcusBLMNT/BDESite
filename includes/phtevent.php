<?php

if (isset($_POST['upload'])) {
    $target = "../public/images/" . basename($_FILES['image']['name']);

    $db = mysqli_connect($host = "localhost", $user = "root", $password = "", $database = "testweb");
    $photo = $_FILES['image']['name'];
    $description = mysqli_real_escape_string($db, $_POST['description']);



    $sql = "INSERT INTO photo (url,description)  VALUES ('$photo', '$description')";
    // execute query
    mysqli_query($db, $sql);

    if (move_uploaded_file($_FILES['image']['name'], $target)) {
        $msg = "Image uploaded successfully";
    } else {
        $msg = "Failed to upload image";
    }
}
$result = mysqli_query($db, "SELECT * FROM photo");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Image Upload</title>
    <link rel="stylesheet" type="text/css" href="../public/css/phtevent.css">

</head>

<body>
    <div id="content">
        <?php
        while ($row = mysqli_fetch_array($result)) {
            echo "<div id='img_div'>";
            echo "<img src='../public/images/" . $row['url'] . "' >";
            echo "<p>" . $row['description'] . "</p>";
            echo "</div>";
        }
        ?>

        <form method="POST" action="../includes/phtevent.php" enctype="multipart/form-data">
            <input type="hidden" name="size" value="1000000">
            <div>
                <input type="file" name="image">
            </div>
            <div>
                <textarea id="text" cols="40" rows="4" name="description" placeholder="..."></textarea>
            </div>
            <div>
                <button type="submit" name="upload">Poster</button>
            </div>
        </form>
    </div>
</body>

</html>