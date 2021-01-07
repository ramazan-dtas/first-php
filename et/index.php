<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Document</title>
<link rel="stylesheet" href="style.css">
</head>
<Style>
body {
margin: 0;
padding: 0;
background: linear-gradient(to left, #8942a8, #ba382f);
}

.loginmenu {
width: 280px;
position: absolute;
top: 30%;
left: 50%;
transform: translate(-50%, -50%);
}
.loginmenu h1 {
float: center;
font-size: 20px;
border-bottom: 3px solid;
margin-bottom: 40px;
padding: 13px 0;

}

.textbox {
width: 100%;
overflow: hidden;
font-size: 20px;
padding: 8px 0;
margin: 8px 0;
border-bottom: 1px solid;

}

.textbox input {
border: none;
outline: none;
background: none;
width: 100%;
}

.btn {
width: 100%;
background: none;
border: 2px solid;
padding: 5px;
}

.animation-area{
width: 100%;
height: 100vh;
}

.box-area{
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
overflow: hidden;
}

.box-area li{
position: absolute;
display: block;
list-style: none;
width: 25px;
height: 25px;
background: rgba(255, 255, 255, 0.2);
animation: animate 20s linear infinite;
bottom: -150px;
}

.box-area li:nth-child(1){
left: 86%;
width: 80px;
height: 80px;
animation-delay: 0s;
}

.box-area li:nth-child(2){
left: 12%;
width: 30px;
height: 30px;
animation-delay: 1.5s;
animation-duration: 10s;
}

.box-area li:nth-child(3){
left: 70%;
width: 100px;
height: 100px;
animation-delay: 5.5s;
}

.box-area li:nth-child(4){
left: 42%;
width: 150px;
height: 150px;
animation-delay: 0s;
animation-duration: 15s;
}

.box-area li:nth-child(5){
left: 65%;
width: 40px;
height: 40px;
animation-delay: 0s;
}

.box-area li:nth-child(6){
left: 15%;
width: 110px;
height: 110px;
animation-delay: 3.5s;
}

@keyframes animate{
0%{
transform: translateY(-1200px) rotate(360deg);
opacity: 1;
}

100%{
transform: translateY(0px) rotate(0deg);
opacity: 0;
}
}
</Style>

<body>
<div class="animation-area">
<ul class="box-area">
<li></li>
<li></li>
<li></li>
<li></li>
<li></li>
<li></li>
</ul>

<form action="index.php" method="POST">
<div class="loginmenu">
<h1>Input kunde information</h1>
<div class="textbox">
<input type="text" placeholder="navn" name="navn" value="">
</div>
<div class="textbox">
<input type="text" placeholder="kode" name="kode" value="">
</div>
<div class="textbox">
<input type="date" placeholder="dato" name="dato" value="">
</div>


<input class = "submit" type="submit" name="submit" value="Insert">

<?php

$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, "php");
if(isset($_POST['submit' ])){

$navn = $_POST['navn'];
$kode = $_POST['kode'];
$dato = $_POST['dato'];


if($navn!='' && $kode!='' && $dato!=''){
    $query = mysqli_query($connection, "INSERT INTO user(navn, kode, dato) values
    ('$navn','$kode','$dato')");
    echo "<br/><br/><span>Success</span>";
    
    } else{
    echo "<p>Failed</p>";
    }
    }
    mysqli_close($connection);

?>
</div>
</form>
<?php
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Id</th><th>Firstname</th><th>Lastname</th><th>Date</th></tr>";

class TableRows extends RecursiveIteratorIterator {
function __construct($it) {
parent::__construct($it, self::LEAVES_ONLY);
}

function current() {
return "<td style='width: 100px; border: 1px solid black;'>" . parent::current(). "</td>";
}
function beginChildren() {
echo "<tr>";
}

function endChildren() {
echo "</tr>" . "\n";
}
}
// opg 5
$servername ="localhost";
$username = "root";
$password = "";
$dbname = "php";

try {
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username,
$password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("SELECT id, navn, kode, dato FROM user");
$stmt->execute();

// set the resulting array to associative
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
echo $v;
}
}
catch(PDOException $e) {
echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>
</div>

</body>

</html>