<?php 

    session_start(); 
    include('config/db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration System PDO</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

  <div class="box">
    <div class="container">
        <div class="top">
            <div class="logo">
                <img src="images/a.png" alt="logo" class="logo">
            </div>
            <div class="logo-title">	
                <header><h4>Login</h4></header>
            </div>
        </div>
        <hr>
        <form action="login_db.php" method="post">
            <?php if(isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php 
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>
            <?php if(isset($_SESSION['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php 
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </div>
            <?php } ?>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" value="<?php if (isset($_COOKIE['user_login'])) { echo $_COOKIE['user_login']; }?>" name="email" aria-describedby="email">
                <i class='bx bx-user' ></i>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" value="<?php if (isset($_COOKIE['user_password'])) { echo $_COOKIE['user_password']; }?>" name="password">
                <i class='bx bx-lock-alt' ></i>
            </div>

            <div class="gg">
					<button type="submit" name="signin" class="regit">Login</button>
			</div>

			</p>
			
			<div class="gg">
				<span>Not a member? </span>
				<a href="register.php">
					<input type="button" class="regit" value="  Sign in  ">
				</a>
			</div>
			<p>
			<div class="gg">
				<span>OR</span>
				<a href="guest.php">
					<input type="button" class="guest" value="    Guest    ">
				</a>
			</div>

        </form>
        <hr>
    </div>
    
</body>
</html>