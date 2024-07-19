<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "RishtonAcademyDB";
$link = new mysqli($servername, $username, $password, $dbname);

if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}

$type = $_GET['type'];
$employees = [];

if ($type == 'Teacher') {
    $result = $link->query("SELECT TeacherID AS id, Name FROM Teacher");
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
} elseif ($type == 'TeachingAssistant') {
    $result = $link->query("SELECT AssistantID AS id, Name FROM TeachingAssistant");
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($employees);
$link->close();
?>
