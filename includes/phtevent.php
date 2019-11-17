<?php
$connect = mysqli_connect("localhost", "root", "", "testweb");
if (isset($_POST["insert"])) {
    $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
    $query = "INSERT INTO tbl_images(name) VALUES ('$file')";
    if (mysqli_query($connect, $query)) {
        echo '<script>alert("Image Inserted into Database")</script>';
    }
}

$connect = mysqli_connect("localhost", "root", "", "testweb");
if (isset($_POST["poster"])) {
    $file = addslashes(file_get_contents($_FILES["texte"]["tmp_name"]));
    $query = "INSERT INTO commentaire(name) VALUES ('$file')";
    if (mysqli_query($connect, $query)) {
        echo '<script>alert("comment Inserted into Database")</script>';
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>POSTE EVENT</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body>
    <br /><br />
    <div class="container" style="width:500px;">
        <h3>Ajouter une photo à cette évenement</h3>
        <br />
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="image" id="image" />
            <br />
            <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-info" />
        </form>
        <br />
        <br />
        <table class="table table-bordered">
            <tr>
                <th>Image</th>
            </tr>
            <?php
            $query = "SELECT * FROM tbl_images ORDER BY id DESC";
            $result = mysqli_query($connect, $query);
            while ($row = mysqli_fetch_array($result)) {
                echo '  
                          <tr>  
                               <td>  
                                    <img src="data:image/jpeg;base64,' . base64_encode($row['name']) . '" height="200" width="200" class="img-thumnail" />  
                               </td>  
                          </tr>  
                     ';
            }
            ?>


        </table>
        <form action="" method="">
            <label> Commentaire:<br><textarea cols="45" rows="5" name="mes"></textarea></label><br>
            <input type="submit" name="poster">
            <?php
            $query = "SELECT * FROM commentaire ORDER BY id DESC";
            $result = mysqli_query($connect, $query);
            while ($row = mysqli_fetch_array($result)) {
                echo 'ok';
            }
            ?>
        </form>


    </div>
</body>


</html>
<script>
    $(document).ready(function() {
        $('#insert').click(function() {
            var image_name = $('#image').val();
            if (image_name == '') {
                alert("veuillez selectionner une image");
                return false;
            } else {
                var extension = $('#image').val().split('.').pop().toLowerCase();
                if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                    alert('Format invalide');
                    $('#image').val('');
                    return false;
                }
            }
        });
    });
</script>