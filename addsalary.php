<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Salary - School Management System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Add a Salary</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="mt-4">
            <div class="form-group">
                <label for="Amount">Amount</label>
                <input type="text" class="form-control" id="Amount" name="Amount" required>
            </div>
            <div class="form-group">
                <label for="EmployeeType">Employee Type</label>
                <select class="form-control" id="EmployeeType" name="EmployeeType" required>
                    <option value="">Select Employee Type</option>
                    <option value="Teacher">Teacher</option>
                    <option value="TeachingAssistant">Teaching Assistant</option>
                </select>
            </div>
            <div class="form-group">
                <label for="EmployeeID">Employee ID</label>
                <input type="text" class="form-control" id="EmployeeID" name="EmployeeID" required>
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

            $Amount = $link->real_escape_string($_POST['Amount']);
            $EmployeeType = $link->real_escape_string($_POST['EmployeeType']);
            $EmployeeID = $link->real_escape_string($_POST['EmployeeID']);

            $stmt = $link->prepare("INSERT INTO Salary (Amount, EmployeeType, EmployeeID) VALUES (?, ?, ?)");
            $stmt->bind_param("dsi", $Amount, $EmployeeType, $EmployeeID);

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
