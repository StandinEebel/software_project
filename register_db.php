<?php 

    session_start();
    require_once 'config/db.php';

    if (isset($_POST['signup'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];
        $urole = 'user';

        if (empty($firstname)) {
            $_SESSION['error'] = 'Please Enter Your Firstname';
            header("location: register.php");
        } else if (empty($lastname)) {
            $_SESSION['error'] = 'Please Enter Your Lastname';
            header("location: register.php");
        } else if (empty($email)) {
            $_SESSION['error'] = 'Please Enter Your Email';
            header("location: register.php");
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'Wrong Email Format';
            header("location: register.php");
        } else if (empty($password)) {
            $_SESSION['error'] = 'Please Enter Your Password';
            header("location: register.php");
        } else if (strlen($_POST['password']) < 5) {
            $_SESSION['error'] = 'Wrong Format, Password Must Have At Least 6 Characters';
            header("location: register.php");
        } else if (empty($c_password)) {
            $_SESSION['error'] = 'Please Confirm Your Password';
            header("location: register.php");
        } else if ($password != $c_password) {
            $_SESSION['error'] = 'Password Not Match';
            header("location: register.php");
        } else {
            try {

                $check_email = $conn->prepare("SELECT email FROM users WHERE email = :email");
                $check_email->bindParam(":email", $email);
                $check_email->execute();
                $row = $check_email->fetch(PDO::FETCH_ASSOC);

                if ($row['email'] == $email) {
                    $_SESSION['warning'] = "Already Have This Email <a href='login.php'>Click Here</a> To Login";
                    header("location: register.php");
                } else if (!isset($_SESSION['error'])) {
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("INSERT INTO users(firstname, lastname, email, password, urole) 
                                            VALUES(:firstname, :lastname, :email, :password, :urole)");
                    $stmt->bindParam(":firstname", $firstname);
                    $stmt->bindParam(":lastname", $lastname);
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":password", $passwordHash);
                    $stmt->bindParam(":urole", $urole);
                    $stmt->execute();
                    $_SESSION['success'] = "Register Complete!! <a href='login.php' class='alert-link'>Click Here</a> To Login";
                    header("location: register.php");
                } else {
                    $_SESSION['error'] = "Register Failed, Please Try Again";
                    header("location: register.php");
                }

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }


?>