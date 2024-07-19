<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student - School Management System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Add a Student</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="mt-4">
            <div class="form-group">
                <label for="StudentName">Student Name</label>
                <input type="text" class="form-control" id="StudentName" name="StudentName" required>
            </div>
            <div class="form-group">
                <label for="StudentAddress">Student Address</label>
                <input type="text" class="form-control" id="StudentAddress" name="StudentAddress" required>
            </div>
            <div class="form-group">
                <label for="MedicalInformation">Medical Information</label>
                <textarea class="form-control" id="MedicalInformation" name="MedicalInformation"></textarea>
            </div>
            <div class="form-group">
                <label for="ClassID">Class</label>
                <select class="form-control" id="ClassID" name="ClassID" required>
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "password";
                    $dbname = "RishtonAcademyDB";

                    $link = new mysqli($servername, $username, $password, $dbname);

                    if ($link->connect_error) {
                        die("Connection failed: " . $link->connect_error);
                    }

                    $sql = "SELECT ClassID, ClassName FROM Class";
                    $result = $link->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["ClassID"] . "'>" . $row["ClassName"] . "</option>";
                        }
                    }

                    $link->close();
                    ?>
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>

        <?php
        $link = new mysqli($servername, $username, $password, $dbname);

        if ($link->connect_error) {
            die("Connection failed: " . $link->connect_error);
        }

        if (isset($_POST['submit'])) {
            $StudentName = $link->real_escape_string($_POST['StudentName']);
            $StudentAddress = $link->real_escape_string($_POST['StudentAddress']);
            $MedicalInformation = $link->real_escape_string($_POST['MedicalInformation']);
            $ClassID = $link->real_escape_string($_POST['ClassID']);

            $stmt = $link->prepare("INSERT INTO Pupil (Name, Address, MedicalInformation, ClassID) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sssi", $StudentName, $StudentAddress, $MedicalInformation, $ClassID);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success mt-4'>New record created successfully.</div>";
            } else {
                echo "<div class='alert alert-danger mt-4'>Error: " . $stmt->error . "</div>";
            }

            $stmt->close();
        }

        $link->close();
        ?>
    </div>
</body>
</html>
