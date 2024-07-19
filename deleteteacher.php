<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "RishtonAcademyDB";
$link = new mysqli($servername, $username, $password, $dbname);

if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $link->prepare("DELETE FROM Teacher WHERE TeacherID=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
}

$link->close();
header("Location: seeteacher.php");
exit();
?>
