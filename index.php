<?php
$msg = "";
// if upload button is pressed

if (isset($_POST['upload'])) {
    // the path to store the upload images
    $target = "assets/images/posts/" . basename(($_FILES['image']['name']));

    // connect to database

    $db = mysqli_connect('localhost', 'root', '', 'photos');
    $image = $_FILES['image']['name'];
    $text = $_POST['text'];

    $sql = "INSERT INTO images (image, text)VALUES ('$image', '$text')";
    if (mysqli_query($db, $sql)) {

        $msg = "Image uploaded successfully";
    } else {

        $msg = "There was a problem uploading image" . mysqli_errno($db);
    }

    // now lets move the uploaded image into the folder images
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
    } else {
        $msg = "There was a problem uploading image";
    }
}


?>





<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Social Point</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <h1>Hello, world!</h1>



    <form method="post" action="index.php" enctype="multipart/form-data">
        <textarea name="text" class="form-control w-50" aria-label="With textarea" placeholder="write Your Post"></textarea>
        <div class='d-flex mt-3 w-50'>
            <!-- <button type="button">Choose File</button> -->
            <!-- <h2 class='flex-grow-1 fs-5 mx-2'>No file chosen</h2> -->

            <input name='image' class="form-control w-25 flex-grow-1 " type="file" id="select_post_img">
            <button name="upload" type="submit" class="btn btn-primary">Post</button>
        </div>
    </form>

    <?php
    echo "<p>$msg</p>";
    ?>


    <?php
    $db = mysqli_connect('localhost', 'root', '', 'photos');
    $sql = "SELECT * FROM images";
    $result = mysqli_query($db, $sql);

    while ($row = mysqli_fetch_array($result)) {
        echo "<div id = 'img_div'>";
        echo "<img src='assets/images/posts/".$row['image'] . "'>";
        echo "<p>" . $row['text'] . "</p>";
        echo "</div>";
    }

    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>