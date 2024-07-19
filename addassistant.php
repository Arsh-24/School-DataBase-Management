<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Teaching Assistant - School Management System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Add a Teaching Assistant</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="mt-4">
            <div class="form-group">
                <label for="AssistantName">Assistant Name</label>
                <input type="text" class="form-control" id="AssistantName" name="AssistantName" required>
            </div>
            <div class="form-group">
                <label for="AssistantAddress">Assistant Address</label>
                <input type="text" class="form-control" id="AssistantAddress" name="AssistantAddress" required>
            </div>
            <div class="form-group">
                <label for="AssistantPhone">Assistant Phone</label>
                <input type="text" class="form-control" id="AssistantPhone" name="AssistantPhone" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $servername = "localhost";
            $username = "root";
            $password = "password";
            $dbname = "RishtonAcademyDB";

            $link = new mysqli($servername, $username, $password, $dbname);

            if ($link->connect_error) {
                die("Connection failed: " . $link->connect_error);
            }

            $AssistantName = $link->real_escape_string($_POST['AssistantName']);
            $AssistantAddress = $link->real_escape_string($_POST['AssistantAddress']);
            $AssistantPhone = $link->real_escape_string($_POST['AssistantPhone']);

            $stmt = $link->prepare("INSERT INTO TeachingAssistant (Name, Address, Phone) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $AssistantName, $AssistantAddress, $AssistantPhone);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success mt-4'>New record created successfully.</div>";
            } else {
                echo "<div class='alert alert-danger mt-4'>Error: " . $stmt->error . "</div>";
            }

            $stmt->close();
            $link->close();
        }
        ?>
    </div>
</body>
</html>
