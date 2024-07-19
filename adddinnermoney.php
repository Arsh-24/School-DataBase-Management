<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Dinner Money - School Management System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Add Dinner Money</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="mt-4">
            <div class="form-group">
                <label for="PupilID">Pupil ID</label>
                <input type="text" class="form-control" id="PupilID" name="PupilID" required>
            </div>
            <div class="form-group">
                <label for="Amount">Amount</label>
                <input type="text" class="form-control" id="Amount" name="Amount" required>
            </div>
            <div class="form-group">
                <label for="DatePaid">Date Paid</label>
                <input type="date" class="form-control" id="DatePaid" name="DatePaid" required>
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

            $PupilID = $link->real_escape_string($_POST['PupilID']);
            $Amount = $link->real_escape_string($_POST['Amount']);
            $DatePaid = $link->real_escape_string($_POST['DatePaid']);

            $stmt = $link->prepare("INSERT INTO DinnerMoney (PupilID, Amount, DatePaid) VALUES (?, ?, ?)");
            $stmt->bind_param("ids", $PupilID, $Amount, $DatePaid);

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
