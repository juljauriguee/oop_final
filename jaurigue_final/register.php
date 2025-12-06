<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INVENTIFY - Register</title>
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
        .form-register {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .form-register form {
            background: #ffffff;
            padding: 30px;
            width: 450px;       
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-register .form-name {
            display: flex;
            gap: 10px;
        }
        .form-register .form-name .contents {
            flex: 1;
        }
        .form-register .form-name .contents label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
            margin-top: 10px;
        }
        .form-register .form-name .contents input {
            width: 90%;
        }
        .form-register label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
            margin-top: 10px;
        }
        .form-register input {
            width: 95%;
            padding: 10px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-register button {
            margin-top: 10px;
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-register p {
            text-align: center;
            font-size: 14px;
            margin-top: 15px;
        }
        .form-register button:hover {
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