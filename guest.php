<?php 

    session_start();
    include_once 'db_conn.php';

    $dbHost = "localhost";
    $dbUser = "root";
    $dbPassword = "root";
    $dbName = "otr_authen";

    try {
      $dsn = "mysql:host=" . $dbHost . ";dbname=" . $dbName;
      $pdo = new PDO($dsn, $dbUser, $dbPassword);
    } catch(PDOException $e) {
        echo "DB Connection Failed: " . $e->getMessage();
    }

    $status = "";
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $message = $_POST['message'];

    if(empty($name) || empty($email) || empty($message)) {
      $status = "All fields are compulsory.";
    } else {
    if(strlen($name) >= 255 || !preg_match("/^[a-zA-Z-'\s]+$/", $name)) {
      $status = "Please enter a valid name";
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $status = "Please enter a valid email";
    } else {

      $sql = "INSERT INTO review (name, email, message) VALUES (:name, :email, :message)";

      $stmt = $pdo->prepare($sql);
      
      $stmt->execute(['name' => $name, 'email' => $email, 'message' => $message]);

      $status = "Your message was sent";
      $name = "";
      $email = "";
      $message = "";
     }
    }
  }

?>

<!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->
<html lang="en" dir="ltr">
  <head>
   <meta charset="UTF-8">
   <title>OnTheRoad</title>
 <link rel="stylesheet" href="style0.css">
  <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
   <style>
    .space{
      margin-block-start: -340px;
    }
    .space1{
      margin-block-start: -230px;
    }
    .space2{
      margin-block-start: -110px;
    }

   </style>
<body>
  <nav>
    <div class="navbar">
      <div class="logo"><a href="mainpage.php">OnTheRoad</a></div>
      <li>Please Login To Access SearchBar</li>
      <ul class="menu">
        <li><a href="#Weather">Climate</a></li>
        <li><a href="#place">Places</a></li>
        <li><a href="#food_s">Food</a></li>
        <li><a href="#Suggestion">Suggestion</a></li>
        <li><a href="#Review">Review</a></li>
        <li><a href="#"></a></li> 
        <form method="GET" action="searchguest.php">
            <input type="text" name="query" placeholder="Search...">
            <button type="submit">Search</button>
        </form>  
        <li><a href="#"></a></li> 
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
      </ul>
    </div>
  </nav>

  <div class='space1'></div>

   <section id="Weather">
        <?php include 'Weather.php';?>
    </section>

    <div class='space1'></div>

    <?php 
          $sql = "SELECT * FROM travel WHERE City = 'Bangkok' AND Label = 'Climate';";
          $result = mysqli_query($conn, $sql);
          $resultCheck = mysqli_num_rows($result);

          if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<h1>" . $row['City'] . ", " . $row['Country'] . "<br><br>" . "</h1>";
              echo "<p style='font-size:200%'>" . $row['Content'] . "<br><br>" . "</p>";
              $image_path = 'tmp/'.$row["image_file"];
              echo '<img src="' . $image_path . '" alt="Image Description">';   
            }
          }
    ?>

    <div class='space2'></div>

    <section id="place">
        <?php include_once 'place.php'; ?>
    </section>

    <div class='space2'></div>

    <?php
          $sql = "SELECT * FROM travel WHERE City = 'Bangkok' AND Label = 'Places';";
          $result = mysqli_query($conn, $sql);
          $resultCheck = mysqli_num_rows($result);

          if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<p style='font-size:200%'>" . $row['Content'] . "<br><br>" . "</p>";
              $image_path = 'tmp/'.$row["image_file"];
              echo '<img src="' . $image_path . '" alt="Image Description"> . "<br><br><br><br><br>"';   
            }
          }
    ?>

    <div class='space1'></div>  

    <section id="food_s">
        <?php include 'food.php';?>
    </section> 

    <div class='space2'></div>  

    <?php
          $sql = "SELECT * FROM travel WHERE City = 'Bangkok' AND Label = 'Food';";
          $result = mysqli_query($conn, $sql);
          $resultCheck = mysqli_num_rows($result);

          if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<p style='font-size:200%'>" . $row['Content'] . "<br><br>" . "</p>";
              $image_path = 'tmp/'.$row["image_file"];
              echo '<img src="' . $image_path . '" alt="Image Description"> . "<br><br><br><br><br>"';   
            }
          }
    ?>

    <div class='space'></div>  

    <section id="Suggestion">
        <?php include 'Suggestion.php';?>
    </section> 

    <div class='space1'></div>  

    <?php
          $sql = "SELECT * FROM travel WHERE City = 'Bangkok' AND Label = 'Suggestion';";
          $result = mysqli_query($conn, $sql);
          $resultCheck = mysqli_num_rows($result);

          if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<p style='font-size:200%'>" . $row['Content'] . "<br><br>" . "</p>";
              $image_path = 'tmp/'.$row["image_file"];
              echo '<img src="' . $image_path . '" alt="Image Description">';   
            }
          }
    ?>

    <div class='space2'></div>

    <section id="Review">
      <?php include 'review.php'; ?>
    </section> 

    <div class='space2'></div>

    <?php
      $sql = "SELECT * FROM review;";
      $result = mysqli_query($conn, $sql);
      $resultCheck = mysqli_num_rows($result);

      if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<p style='font-size:200%'>" . $row['name'] . " " ."(". $row['email'] . ")". "<br>" . "</p>";
          echo "<p style='font-size:200%'>" . $row['message'] . "<br>" . "</p>";
          echo "<p style='font-size:200%'>" . $row['created_at'] . "<br><br>" . "</p>";
        }
      }
    ?>

  <div class="button">
    <a href="#Weather"><i class="fas fa-arrow-up"></i></a>
  </div>
 
</body>
</html>