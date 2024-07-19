<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Salary - School Management System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit a Salary</h2>
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
            $result = $link->query("SELECT * FROM Salary WHERE SalaryID=$id");
            $row = $result->fetch_assoc();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $SalaryID = $_POST['SalaryID'];
            $Amount = $link->real_escape_string($_POST['Amount']);
            $EmployeeType = $link->real_escape_string($_POST['EmployeeType']);
            $EmployeeID = $link->real_escape_string($_POST['EmployeeID']);

            $stmt = $link->prepare("UPDATE Salary SET Amount=?, EmployeeType=?, EmployeeID=? WHERE SalaryID=?");
            $stmt->bind_param("dsii", $Amount, $EmployeeType, $EmployeeID, $SalaryID);

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
            <input type="hidden" name="SalaryID" value="<?php echo $row['SalaryID']; ?>">
            <div class="form-group">
                <label for="Amount">Amount</label>
                <input type="text" class="form-control" id="Amount" name="Amount" value="<?php echo $row['Amount']; ?>" required>
            </div>
            <div class="form-group">
                <label for="EmployeeType">Employee Type</label>
                <select class="form-control" id="EmployeeType" name="EmployeeType" required>
                    <option value="Teacher" <?php echo $row['EmployeeType'] == 'Teacher' ? 'selected' : ''; ?>>Teacher</option>
                    <option value="TeachingAssistant" <?php echo $row['EmployeeType'] == 'TeachingAssistant' ? 'selected' : ''; ?>>Teaching Assistant</option>
                </select>
            </div>
            <div class="form-group">
                <label for="EmployeeID">Employee ID</label>
                <input type="text" class="form-control" id="EmployeeID" name="EmployeeID" value="<?php echo $row['EmployeeID']; ?>" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
