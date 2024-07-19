<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Teaching Assistant - School Management System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit a Teaching Assistant</h2>
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
            $result = $link->query("SELECT * FROM TeachingAssistant WHERE AssistantID=$id");
            $row = $result->fetch_assoc();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $AssistantID = $_POST['AssistantID'];
            $Name = $link->real_escape_string($_POST['Name']);
            $Address = $link->real_escape_string($_POST['Address']);
            $Phone = $link->real_escape_string($_POST['Phone']);

            $stmt = $link->prepare("UPDATE TeachingAssistant SET Name=?, Address=?, Phone=? WHERE AssistantID=?");
            $stmt->bind_param("sssi", $Name, $Address, $Phone, $AssistantID);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success mt-4'>Record updated successfully.</div>";
            } else {
                echo "<div class='alert alert-danger mt-4'>Error: " . $stmt->error . "</div>";
            }

            $stmt->close();
            $link->close();
        }
        ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="mt-4">
            <input type="hidden" name="AssistantID" value="<?php echo $row['AssistantID']; ?>">
            <div class="form-group">
                <label for="Name">Name</label>
                <input type="text" class="form-control" id="Name" name="Name" value="<?php echo $row['Name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="Address">Address</label>
                <input type="text" class="form-control" id="Address" name="Address" value="<?php echo $row['Address']; ?>" required>
            </div>
            <div class="form-group">
                <label for="Phone">Phone</label>
                <input type="text" class="form-control" id="Phone" name="Phone" value="<?php echo $row['Phone']; ?>" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
