<?php
    include 'connect.php';
    if(isset($_GET['deleteid'])){
        $id = $_GET['deleteid'];

        $sql = "DELETE FROM `travel` WHERE id=$id";
        $result = mysqli_query($connect, $sql);
        if($result){
            header('location:displaydata.php');
        } else{
            die(mysqli_error($connect));
        }
    }
?>