<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Parent - School Management System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Add a Parent</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="mt-4">
            <div class="form-group">
                <label for="ParentName">Parent Name</label>
                <input type="text" class="form-control" id="ParentName" name="ParentName" required>
            </div>
            <div class="form-group">
                <label for="ParentAddress">Parent Address</label>
                <input type="text" class="form-control" id="ParentAddress" name="ParentAddress" required>
            </div>
            <div class="form-group">
                <label for="ParentEmail">Parent Email</label>
                <input type="email" class="form-control" id="ParentEmail" name="ParentEmail" required>
            </div>
            <div class="form-group">
                <label for="ParentPhone">Parent Phone</label>
                <input type="text" class="form-control" id="ParentPhone" name="ParentPhone" required>
            </div>
            <div class="form-group">
                <label for="PupilID">Assign Pupils (Ctrl+Click to select multiple)</label>
                <select multiple class="form-control" id="PupilID" name="PupilID[]">
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "password";
                    $dbname = "RishtonAcademyDB";

                    $link = new mysqli($servername, $username, $password, $dbname);

                    if ($link->connect_error) {
                        die("Connection failed: " . $link->connect_error);
                    }

                    $sql = "SELECT PupilID, Name FROM Pupil";
                    $result = $link->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["PupilID"] . "'>" . $row["Name"] . "</option>";
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
            $ParentName = $link->real_escape_string($_POST['ParentName']);
            $ParentAddress = $link->real_escape_string($_POST['ParentAddress']);
            $ParentEmail = $link->real_escape_string($_POST['ParentEmail']);
            $ParentPhone = $link->real_escape_string($_POST['ParentPhone']);
            $PupilIDs = $_POST['PupilID'];

            $stmt = $link->prepare("INSERT INTO Parent (Name, Address, Email, Phone) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $ParentName, $ParentAddress, $ParentEmail, $ParentPhone);

            if ($stmt->execute()) {
                $parentID = $stmt->insert_id;
                foreach ($PupilIDs as $pupilID) {
                    $link->query("INSERT INTO Pupil_Parent (PupilID, ParentID) VALUES ($pupilID, $parentID)");
                }
                echo "<div class='alert alert-success mt-4'>New record created successfully and pupils assigned.</div>";
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
