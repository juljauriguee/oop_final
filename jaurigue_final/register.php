<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INVENTIFY - Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        require "user.php";
        $user = new User();
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $firstName=$_POST["firstName"];
            $lastName=$_POST["lastName"];
            $username=$_POST["username"];
            $password=$_POST["password"];


            $message = $user->register($firstName, $lastName, $username, $password);
        }
    ?>
        <div class="whole">
            <div class="welcome">
                <div class="container">
                    <img src="unnamed.jpg" alt="">
                        <span>INVENTIFY</span>
                            <p>"Knows what's on your shelves better than you do."</p> 
                </div>
            </div>

            <div class="form-register">
                <form action="register.php" method="POST">
               
                <h1 style="text-align: center; margin-bottom: 20px; font-size: 34px;">Register</h1>

                <?php
                    if (!empty($message)) {
                        echo "<p style='text-align: center; margin-bottom: 18px; font-size: 15px;'>$message <a href='login.php'>Login Here!</a></p>";
                    }
                 ?>
                 <div class="form-name">
                    <div class="contents">
                    <label for="firstName">First Name:</label>
                    <input type="text" name="firstName" required placeholder="First Name"><br>
                    </div>
                    <div class="contents">
                    <label for="lastName">Last Name:</label>
                    <input type="text" name="lastName" required placeholder="Last Name"><br>
                    </div>
                </div>

                    <label for="uname">Username:</label>
                    <input type="text" name="username" required placeholder="Enter Username"><br>

                    <label for="password">Password:</label>
                    <input type="password" name="password" required placeholder="Enter Password"> <br>

                    <button type="submit">Register</button>

                    <p>Already have an account? <a href="login.php">Login</a></p>
                </form>
            </div>

        </div>

            <footer>
                <h2>JIJI TECHNOLOGIES</h2>

                <hr>
                
                <h4>©2025 JIJITECH. All Rights Reserved.</h4>
            </footer>

</body>
</html>