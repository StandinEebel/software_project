<?php
    $connect = new mysqli('localhost', 'root', 'root', 'otr_authen');

    if(!$connect){
        die(mysqli_error($connect));
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<body>
    <br>
    <h1 style="text-align:center;">Welcome To Admin Page</h1>
    <div class="container">
        <button class="btn btn-primary my-5"><a href="adddata.php" class="text-light">Add Data</a></button>    
        <button class="btn btn-danger my-5"><a href="admin.php" class="text-light">Back To Homepage</a></button>    
    <table class="table">
    <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">Country</th>
          <th scope="col">City</th>
          <th scope="col">Label</th>
          <th scope="col">Content</th>
          <th scope="col">Image File</th>
          <th scope="col">Method</th>
        </tr>
    </thead>
    <tbody>

    <?php
        $sql = "SELECT * FROM `travel`";
        $result = mysqli_query($connect, $sql);
        if($result){
            while($row=mysqli_fetch_assoc($result)){
                $id = $row['id'];
                $country = $row['Country'];
                $city = $row['City'];
                $label = $row['Label'];
                $content = $row['Content'];
                $image = $row['image_file'];
                echo ' <tr> 
                <th scope="row"> '.$id.' </th>
                <td> '.$country.' </td>
                <td> '.$city.' </td>
                <td> '.$label.' </td>
                <td> '.$content.' </td>
                <td> '.$image.' </td>
                <td>
                <button class="btn btn-primary"><a href="update.php?updateid='.$id.'" class="text-light">Update</a></button>
                <button class="btn btn-danger"><a href="delete.php?deleteid='.$id.'" class="text-light">Delete</a></button>
                </td>
            </tr>';
            }
        }
    ?>

  </tbody>
</table>
</div>

</body>
</html>