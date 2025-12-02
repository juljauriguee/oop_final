<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INVENTIFY - Register</title>
</head>
<body>
    <?php
        require "user.php";
        $user = new User();
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $Fname=$_POST["First name"];
            $Lname=$_POST["Last name"];
            $username=$_POST["username"];
            $password=$_POST["password"];


            $message = $user->register($Fname, $Lname, $username, $password);
        }
    ?>
        <div class="container">


            <div class="form">


                <form action="register.php" method="POST">
               
                <h1 style="text-align: center; margin-bottom: 20px; font-size: 34px;">Register</h1>


                <?php
                    if (!empty($message)) {
                        echo "<p style='text-align: center; margin-bottom: 20px; font-size: 15px;'>$message <a href='login.php'>Login Here!</a></p>";


                    }
                 ?>
                    <label for="First name">First Name:</label>
                    <input type="text" name="First name" required placeholder="First Name"><br>


                    <label for="Last name">Last Name:</label>
                    <input type="text" name="Last name" required placeholder="Last Name"><br>


                    <label for="uname">Username:</label>
                    <input type="text" name="username" required placeholder="Enter Username"><br>


                    <label for="password">Password:</label>
                    <input type="password" name="password" required placeholder="Enter Password"> <br>


                    <button type="submit">Register</button>


                    <p>Already have an account? <a href="login.php">Login</a></p>
                </form>
            </div>
        </div>

</body>
</html>