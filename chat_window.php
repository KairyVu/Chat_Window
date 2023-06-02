<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group chat</title>
    <style>
    * {
        padding: 0;
        margin: 0;
        border: 0;
    }
    
    body {
        background-image: url('background.jpg');
        background-size: 100vw;
        background-attachment: fixed;
        background-repeat: no-repeat;
    }
    
    
    #container {
        background-color: rgba(171, 162, 162, 0.5);
        border: solid thin cyan;
        width: 30vw;
        height: 80vh;
        text-align: left;
        border-radius: 5px;
        margin-right: auto;
        margin-left: auto;
        margin-top: 10vh;
        overflow: auto;
        padding-left: 20px;
        
    }

    input[type="text"] {
        height: 15px;
        width: 15%;
        margin-left: 41%;
        border-radius: 100px;
        padding: 10px;
    }

    input[type="submit"] {
        width: 50px;
        height: 25px;
        border-radius: 100px;
        background-color: aqua;
    }


    </style>
    <script src='display_chat.js'></script>
</head>
<body>
    <div id="container">
        <?php
        error_reporting(0);

        //connection
        include 'signin.php';
        if (!$con) {   
            die("Connection failed: " . mysqli_connect_error()); 
        }
        $sql = 'SELECT name FROM user';
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<span style='font-size: 18px; font-style:italic; font-weight: 800; padding: 5px; background-color: gray; border-radius: 20px; margin-left: 5px; margin-right: 5px'>".ucwords(strtolower($row['name']))." </span>";
            }
            echo "<br><br>";
        }

        ?>
    <div id="chat_box">
    </div>
    
    </div>
    <form method="post">
        <input type="text" name="message">
        <input type="submit" name="submit" value="Send">
    </form>

<?php
if (!$con) {   
    die("Connection failed: " . mysqli_connect_error()); 
} 

if(isset($_POST['submit'])) {
    $message = $_POST['message'];
    $sql = 'INSERT INTO message (name,message) VALUES (\''.mysqli_real_escape_string($con, ucwords(strtolower($_SESSION['name']))).'\', \''.mysqli_real_escape_string($con, $message).'\')';
    $result = mysqli_query($con, $sql);
}

mysqli_close($con); 
?>
</body>
</html>