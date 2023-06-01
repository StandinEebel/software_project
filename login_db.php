<?php 

    session_start();
    require_once 'config/db.php';

    if (isset($_POST['signin'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

      
        if (empty($email)) {
            $_SESSION['error'] = 'Please Enter Your Email';
            header("location: login.php");
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'Wrong Email Format';
            header("location: login.php");
        } else if (empty($password)) {
            $_SESSION['error'] = 'Please Enter Your Password';
            header("location: login.php");
        } else if (strlen($_POST['password']) < 5) {
            $_SESSION['error'] = 'Wrong Format, Password Must Have At Least 6 Characters';
            header("location: login.php");
        } else {
            try {

                $check_data = $conn->prepare("SELECT * FROM users WHERE email = :email");
                $check_data->bindParam(":email", $email);
                $check_data->execute();
                $row = $check_data->fetch(PDO::FETCH_ASSOC);

                if ($check_data->rowCount() > 0) {

                    if ($email == $row['email']) {
                        if (password_verify($password, $row['password'])) {
                            if ($row['urole'] == 'admin') {
                                $_SESSION['admin_login'] = $row['id'];
                                header("location: admin.php");
                            } else {
                                $_SESSION['user_login'] = $row['id'];
                                header("location: user.php");
                            }
                        } else {
                            $_SESSION['error'] = 'Wrong Password';
                            header("location: login.php");
                        }
                    } else {
                        $_SESSION['error'] = 'Wrong Email';
                        header("location: login.php");
                    }
                } else {
                    $_SESSION['error'] = "No User Data";
                    header("location: login.php");
                }

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }


?>