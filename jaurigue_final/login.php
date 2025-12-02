<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INVENTIFY - Login</title>
</head>
<body>
    <?php
                session_start();
                require "user.php";
                $user = new User();


                if($_SERVER["REQUEST_METHOD"]=="POST"){
                    $username=$_POST["username"];
                    $password=$_POST["password"];


                $message = $user->login($username, $password);
                 if($message=="Login Successful."){
                    $_SESSION["username"]= $username;
                    header("Location: dashboard.php");
            }
        }
        ?>

            <div class="form">


                <form action="login.php" method="POST">


                    <h1 style="text-align: center; margin-bottom: 20px; font-size: 34px;">Login</h1>


                 <?php
                    if (!empty($message)) {
                        echo "<p style='text-align: center; margin-bottom: 20px; font-size: 15px;'>$message</p>";
                    }
                 ?>


                    <label for="uname">Username:</label>
                    <input type="text" name="username" required placeholder="Enter Username"><br>


                    <label for="password">Password:</label>
                    <input type="password" name="password" required placeholder="Enter Password"> <br>


                    <button type="submit">Login</button>


                    <p>Don't have an account? <a href="register.php">Register</a></p>
                </form>
            </div>

</body>
</html>