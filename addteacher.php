<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Teacher - School Management System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Add a Teacher</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="mt-4">
            <div class="form-group">
                <label for="TeacherName">Teacher Name</label>
                <input type="text" class="form-control" id="TeacherName" name="TeacherName" required>
            </div>
            <div class="form-group">
                <label for="TeacherAddress">Teacher Address</label>
                <input type="text" class="form-control" id="TeacherAddress" name="TeacherAddress" required>
            </div>
            <div class="form-group">
                <label for="TeacherPhone">Teacher Phone</label>
                <input type="text" class="form-control" id="TeacherPhone" name="TeacherPhone" required>
            </div>
            <div class="form-group">
                <label for="AnnualSalary">Annual Salary</label>
                <input type="text" class="form-control" id="AnnualSalary" name="AnnualSalary" required>
            </div>
            <div class="form-group">
                <label for="BackgroundCheck">Background Check</label>
                <textarea class="form-control" id="BackgroundCheck" name="BackgroundCheck" required></textarea>
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
            $TeacherName = $link->real_escape_string($_POST['TeacherName']);
            $TeacherAddress = $link->real_escape_string($_POST['TeacherAddress']);
            $TeacherPhone = $link->real_escape_string($_POST['TeacherPhone']);
            $AnnualSalary = $link->real_escape_string($_POST['AnnualSalary']);
            $BackgroundCheck = $link->real_escape_string($_POST['BackgroundCheck']);
            $ClassID = $link->real_escape_string($_POST['ClassID']);

            $stmt = $link->prepare("INSERT INTO Teacher (Name, Address, Phone, AnnualSalary, BackgroundCheck, ClassID) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssi", $TeacherName, $TeacherAddress, $TeacherPhone, $AnnualSalary, $BackgroundCheck, $ClassID);

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
