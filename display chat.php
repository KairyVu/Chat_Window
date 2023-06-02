<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
//connection
include 'signin.php';
if (!$con) {   
    die("Connection failed: " . mysqli_connect_error()); 
}
//sql
$sql = "SELECT * FROM message";
$result = mysqli_query($con, $sql);

//printing
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<span style='font-weight:bold; font-size:13pt; color: black'>".$row['name']."</span>&nbsp;&nbsp;";
        echo "<span style='color:white'; text-align: right; font-weight:0>".$row['date']."</span><br>";
        echo "<span style='color:yellow'; text-align:left; font-weight:0>".$row['message']."</span><br>";
    }
}
mysqli_close($con);
?>

</body>
</html>