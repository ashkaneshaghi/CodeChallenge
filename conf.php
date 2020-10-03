<?PHP
$host = 'localhost';
$username = 'root';
$pass = '';

$conn = mysqli_connect($host, $username, $pass);
$db = mysqli_select_db($conn, "rexx_code_challenge");
?>