<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INVENTIFY - Login</title>
    <style>
        body {
            background: #eef3f7;
            font-family: "Poppins", Arial, sans-serif;
        }
        .whole {
            display: flex;
            height: 80vh;
            align-items: center;
            justify-content: center;
        }
        .welcome {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 40px;
        }
        .welcome .container img {
            width: 120px;
            height: auto;
            margin-bottom: 20px;
        }
        .welcome .container span {
            font-size: 40px;
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
        }
        .welcome .container p {
            font-size: 18px;
        }
        .form-login{
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .form-login form{
            background: #ffffff;
            padding: 30px;
            width: 450px;       
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-login label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
            margin-top: 10px;
        }
        .form-login input{
            width: 95%;
            padding: 10px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-login button{
            margin-top: 10px;
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-login p{
            text-align: center;
            font-size: 14px;
            margin-top: 15px;
        }
        .form-login button:hover{
            background: #0056b3;
        }
        footer {
            text-align: center;
            padding: 2px;
            background: #ffffff;
            color: rgb(104, 102, 102);
        }

    </style>
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
        <div class="whole">
            <div class="welcome">
                <div class="container">
                    <img src="unnamed.jpg" alt="">
                        <span>INVENTIFY</span>
                            <p>"Knows what's on your shelves better than you do."</p> 
                </div>
            </div>

            <div class="form-login">
                <form action="login.php" method="POST">
                    <h1 style="text-align: center; margin-bottom: 20px; font-size: 34px;">Login</h1>
                 <?php
                    if (!empty($message)) {
                        echo "<p style='text-align: center; margin-bottom: 18px; font-size: 15px;'>$message</p>";
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
        </div>

            <footer>
                <h2>JIJI TECHNOLOGIES</h2>

                <hr>

                <h4>©2025 JIJITECH. All Rights Reserved.</h4>
            </footer>

</body>
</html>