<?php include 'connect.php'; ?>
<?php
    $country = $_POST['Country'];
    $city = $_POST['City'];
    $label = $_POST['Label'];
    $content = $_POST['Content'];
    $file = $_POST['image'];

    

    mysqli_query($connect, "INSERT INTO travel (Country,City,Label,Content,image_file)
                            VALUES('$country','$city','$label','$content','$file')");

    if (mysqli_affected_rows($connect)>0){
        header('location:displaydata.php');
    }else{
        echo 'No data added';
        echo mysqli_error($connect);
    }
?>