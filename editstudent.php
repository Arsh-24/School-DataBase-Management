<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student - School Management System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit a Student</h2>
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
            $result = $link->query("SELECT * FROM Pupil WHERE PupilID=$id");
            $row = $result->fetch_assoc();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $PupilID = $_POST['PupilID'];
            $Name = $link->real_escape_string($_POST['Name']);
            $Address = $link->real_escape_string($_POST['Address']);
            $MedicalInformation = $link->real_escape_string($_POST['MedicalInformation']);
            $ClassID = $link->real_escape_string($_POST['ClassID']);

            $stmt = $link->prepare("UPDATE Pupil SET Name=?, Address=?, MedicalInformation=?, ClassID=? WHERE PupilID=?");
            $stmt->bind_param("sssii", $Name, $Address, $MedicalInformation, $ClassID, $PupilID);

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
            <input type="hidden" name="PupilID" value="<?php echo $row['PupilID']; ?>">
            <div class="form-group">
                <label for="Name">Name</label>
                <input type="text" class="form-control" id="Name" name="Name" value="<?php echo $row['Name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="Address">Address</label>
                <input type="text" class="form-control" id="Address" name="Address" value="<?php echo $row['Address']; ?>" required>
            </div>
            <div class="form-group">
                <label for="MedicalInformation">Medical Information</label>
                <textarea class="form-control" id="MedicalInformation" name="MedicalInformation" required><?php echo $row['MedicalInformation']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="ClassID">Class</label>
                <select class="form-control" id="ClassID" name="ClassID" required>
                    <?php
                    $result = $link->query("SELECT ClassID, ClassName FROM Class");
                    while ($class = $result->fetch_assoc()) {
                        echo "<option value='" . $class["ClassID"] . "' " . ($class["ClassID"] == $row["ClassID"] ? "selected" : "") . ">" . $class["ClassName"] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
