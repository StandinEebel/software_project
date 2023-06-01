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
    .space0{
      margin-block-start: -330px;
    }
    .space{
      margin-block-start: -230px;
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
        <li><a href="#Weather">Climate</a></li>
        <li><a href="#place">Places</a></li>
        <li><a href="#food1">Food</a></li>
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
   
</html>
<?php
// Connect to the database
$host = "localhost";
$username = "root";
$password = "root";
$dbname = "otr_authen";
$conn = new mysqli($host, $username, $password, $dbname);
session_start();
// Get the search query from the form
$query = $_GET["query"];
$_SESSION['query'] = $query;
$label_c = "Climate";
$label_p = "Place";
$label_f= "Food";
$label_s= "Suggestion";

// Prepare a SQL statement to search for matching records
$sql_c = "SELECT * FROM travel WHERE  City LIKE '%".$query."%' AND Label LIKE '%".$label_c."%' " ;
$sql_p = "SELECT * FROM travel WHERE  City LIKE '%".$query."%' AND Label LIKE '%".$label_p."%' " ;
$sql_f = "SELECT * FROM travel WHERE  City LIKE '%".$query."%' AND Label LIKE '%".$label_f."%' " ;
$sql_s = "SELECT * FROM travel WHERE  City LIKE '%".$query."%' AND Label LIKE '%".$label_s."%' " ;
//$sql = "SELECT * FROM travel WHERE Country LIKE '%".$query."%' OR City LIKE '%".$query."%'" ;

// Execute the SQL statement and get the results
$result_c = $conn->query($sql_c);
$result_p = $conn->query($sql_p);
$result_f = $conn->query($sql_f);
$result_s = $conn->query($sql_s);

?>

<div class='space'></div>

<?php


if ($result_c->num_rows > 0) {
  while ($row = $result_c->fetch_assoc()) {
      // Display the title and content of each matching record
      include_once("Weather.php");

      ?>

      <div class='space'></div>

      <?php

      echo "<h2>".$row["City"].", ".$row["Country"]. "<br><br>"."</h2>";
      echo "<p style='font-size:200%'>".$row["Content"]. "<br><br>"."</p>";
      $image_path = 'tmp/'.$row["image_file"];
      echo '<img src="' . $image_path . '" alt="Image Description">';    
  }
}

else {
    // Display a message if no matching records were found
    echo "No results found.";
  }

?>

<div class='space1'></div>

<?php


if ($result_p->num_rows > 0) {
    while ($row = $result_p->fetch_assoc()) {
        // Display the title and content of each matching record
        include_once("place.php");
        
        ?>

        <div class='space1'></div>

        <?php

        echo "<p style='font-size:200%'>".$row["Content"]. "<br><br>" ."</p>";
        $image_path = 'tmp/'.$row["image_file"];
        echo '<img src="' . $image_path . '" alt="Image Description"> . "<br><br><br><br><br><br><br>"';    
    }
}

else {
    // Display a message if no matching records were found
    echo "No results found.";
  }

?>

<div class='space'></div>
  
<?php  


if ($result_f->num_rows > 0) {
    while ($row = $result_f->fetch_assoc()) {
        // Display the title and content of each matching record
        include_once("food.php");
       
        ?>

        <div class='space1'></div>
  
        <?php  

        echo "<p style='font-size:200%'>".$row["Content"] . "<br><br>"."</p>";
        $image_path = 'tmp/'.$row["image_file"];
        echo '<img src="' . $image_path . '" alt="Image Description"> . "<br><br><br><br><br><br><br>"';    
    }
} 

else {
    // Display a message if no matching records were found
    echo "No results found.";
  }

?>

<div class='space0'></div>
    
<?php    


if ($result_s->num_rows > 0) {
  while ($row = $result_s->fetch_assoc()) {
      // Display the title and content of each matching record
      include_once("Suggestion.php");

      ?>

      <div class='space'></div>

      <?php
      
      echo "<p style='font-size:200%'>".$row["Content"]. "<br><br>"."</p>";
      $image_path = 'tmp/'.$row["image_file"];
      echo '<img src="' . $image_path . '" alt="Image Description">';    
  }
} 

else {
  // Display a message if no matching records were found
  echo "No results found.";
}
?>

<?php

  include_once("review.php");

  ?>

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


<?php
// Close the database connection
$conn->close();

?>
