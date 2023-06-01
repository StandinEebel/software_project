<?php 
    session_start();
    require_once 'db_conn.php';
    if (!isset($_SESSION['admin_login'])) {
        $_SESSION['error'] = 'Please Login!!';
        header('location: login.php');
    }

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
<html lang="en" dir="ltr">
 <head>
    <meta charset="UTF-8">
    <title>OnTheRoad Admin</title>
    <link rel="stylesheet" href="style0.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
   .space{
    margin-block-start: -240px;
   }
   .space1{
      margin-block-start: -100px;
    }
</style>
<body>
    <nav>
    <div class="navbar">
      <div class="logo"><a href="admin.php">OnTheRoad</a></div>
      <li>Welcome Admin</li>
      <ul class="menu">
        <li><a href="#Weather">Weather</a></li>
        <li><a href="#place">Places</a></li>
        <li><a href="#food_s">Food</a></li>
        <li><a href="#Suggestion">Suggestion</a></li>
        <li><a href="#Review">Review</a></li>
        <form method="GET" action="searchadmin.php">
            <input type="text" name="query" placeholder="Search...">
            <button type="submit">Search</button>
        </form>  
        <li><a href="logout.php" class="btn btn-danger">Logout</a></li>
        <li><a href="#"></a></li>    
        <li><a href="displaydata.php">Admin</a></li>
      </ul>
    </div>
  </nav>

<div class='space'></div>

    <section id="Weather">
        <?php include 'Weather.php'; ?>
    </section>

    <div class='space'></div>

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

    <div class='space1'></div>

    <section id="place">
        <?php include 'place.php'; ?>
    </section>

    <div class='space1'></div>
    
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

    <div class='space'></div>

    <section id="food_s">
        <?php include 'food.php'; ?>
    </section> 

    <div class='space1'></div>

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
        <?php include 'Suggestion.php'; ?>
    </section> 

    <div class='space'></div>

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

    <section id="Review">
        <?php include 'review.php'; ?> 
    </section> 

    <div class='space1'></div>

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

    <h1>Write Your Review Here</h1>

    <div style='float:left;'>
    <form method="POST" class="main-form">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="gt-input"
          value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $name ?>">
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" class="gt-input"
          value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $email ?>">
      </div>

      <div class="form-group">
        <label for="message">Message</label>
        <textarea name="message" id="message" cols="30" rows="10"
          class="gt-input gt-text"><?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $message ?>
        </textarea>
      </div>

      <input type="submit" class="gt-button" value="submit">

      <div class="form-status">
        <?php echo $status ?>
      </div>

    </form>
    </div>

    <div class="button">
    <a href="#Weather"><i class="fas fa-arrow-up"></i></a>
  </div>
</body>
</html>


