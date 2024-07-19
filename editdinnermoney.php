<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Dinner Money - School Management System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit Dinner Money</h2>
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
            $result = $link->query("SELECT * FROM DinnerMoney WHERE DinnerMoneyID=$id");
            $row = $result->fetch_assoc();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $DinnerMoneyID = $_POST['DinnerMoneyID'];
            $PupilID = $link->real_escape_string($_POST['PupilID']);
            $Amount = $link->real_escape_string($_POST['Amount']);
            $DatePaid = $link->real_escape_string($_POST['DatePaid']);

            $stmt = $link->prepare("UPDATE DinnerMoney SET PupilID=?, Amount=?, DatePaid=? WHERE DinnerMoneyID=?");
            $stmt->bind_param("idss", $PupilID, $Amount, $DatePaid, $DinnerMoneyID);

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
            <input type="hidden" name="DinnerMoneyID" value="<?php echo $row['DinnerMoneyID']; ?>">
            <div class="form-group">
                <label for="PupilID">Pupil ID</label>
                <input type="text" class="form-control" id="PupilID" name="PupilID" value="<?php echo $row['PupilID']; ?>" required>
            </div>
            <div class="form-group">
                <label for="Amount">Amount</label>
                <input type="text" class="form-control" id="Amount" name="Amount" value="<?php echo $row['Amount']; ?>" required>
            </div>
            <div class="form-group">
                <label for="DatePaid">Date Paid</label>
                <input type="date" class="form-control" id="DatePaid" name="DatePaid" value="<?php echo $row['DatePaid']; ?>" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
