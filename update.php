<?php
    include 'connect.php';
    $id = $_GET['updateid'];
    
    if(isset($_POST['submit'])){
    $country = $_POST['Country'];
    $city = $_POST['City'];
    $label = $_POST['Label'];
    $content = $_POST['Content'];
    $file = $_POST['image_file'];
    
    $sql = "UPDATE `travel` set id=$id, Country='$country', City='$city', Label='$label', Content='$content', image_file='$file' WHERE id=$id";
    $result = mysqli_query($connect, $sql);
    if($result){
        header('location:displaydata.php');
    }else{
        die(mysqli_error($connect));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Update Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <style>
        label{
            display: inline-block;
            width: 100px ;
            margin-bottom: 10px;
        }
    </style>

</head>
<body>
    <h1>Update Data</h1>
    <form method="post" >
        <label>Country </label>
        <input type="text" name="Country"><br>
        <label>City </label>
        <input type="text" name="City"><br>
        <label>Label </label>
        <input type="text" name="Label"><br>
        <label>Content </label>
        <input type="text" name="Content"><br>
        <div class="text-center justify-content-center align-items-center p-4 border-2 border-dashed rounded-3">
            <h6 class="my-2">Select image file to upload</h6>
                <input type="file" name="image" class="form-control streched-link" accept="image/gif, image/jpeg, image/png">
                <p class="small mb-0 mt-2"><b>Note:</b> Only JPG, JPEG, PNG & GIF files are allowed to upload</p>
        </div>
        <input type="submit" name="submit" value="Update" class="btn btn-sm btn-primary mb-3">            
    </form>
    
</body>
</html>