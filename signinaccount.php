<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <style>
        * {
            font-family: 'Times New Roman', Times, serif;
        }
        body {
            background-image: url('background.jpg');
            background-size: 100vw;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        form {
            background-color: rgba(171, 162, 162, 0.5);
            border: solid thin cyan;
            width: 30vw;
            height: 40vh;
            text-align: left;
            border-radius: 5px;
            margin-right: auto;
            margin-left: auto;
            margin-top: 25vh;
        }

        .container {
            padding: 20px;
            text-align: center;
        }

        h1 {
            font-size: 20pt;
            text-align: center;
            margin-top: 50px;
        }

        input[type="submit"] {
            margin-right: auto;
            border-radius: 5px;
            padding: 5px;
            background-color: cyan;
        }

        input[type="text"], input[type="password"] {
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <form method="post">
        <h1>Sign In</h1>
        <div class="container">
            <label for="name">Your name: </label>
            <input type="text" name="name"><br>
        </div>
        
        <div class="container">
            <label for="password">Password: </label>
            <input type="password" name="password">
        </div>
            
        <div class="container">
            <input type="submit" value="Sign in">
        </div>
    </form>

<?php
error_reporting(0);
$_SESSION['name'] = $_POST['name'];

//connection
include 'signin.php';
if (!$con) {   
    die("Connection failed: " . mysqli_connect_error()); 
}

//sql
$sql = 'SELECT* FROM user WHERE name=\''.mysqli_real_escape_string($con, $_SESSION['name']).'\' AND password=\''.mysqli_real_escape_string($con, $_POST['password']).'\';';
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) {
    header('Location:chat_window.php');
}

if (isset($_POST['name']) && mysqli_num_rows($result) == 0) {
    echo "<script type='text/javascript'>alert('User cannot be found')</script>";
}

mysqli_close($con);
?>

</body>
</html>