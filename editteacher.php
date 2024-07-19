<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Teacher - School Management System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit a Teacher</h2>
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
            $id = (int) $_GET['id'];
            $result = $link->query("SELECT * FROM Teacher WHERE TeacherID=$id");
            $row = $result->fetch_assoc();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $TeacherID = (int) $_POST['TeacherID'];
            $Name = $link->real_escape_string($_POST['Name']);
            $Address = $link->real_escape_string($_POST['Address']);
            $Phone = $link->real_escape_string($_POST['Phone']);
            $BackgroundCheck = $link->real_escape_string($_POST['BackgroundCheck']);
            $ClassID = (int) $_POST['ClassID'];

            $stmt = $link->prepare("UPDATE Teacher SET Name=?, Address=?, Phone=?, BackgroundCheck=?, ClassID=? WHERE TeacherID=?");
            $stmt->bind_param("sssisi", $Name, $Address, $Phone, $BackgroundCheck, $ClassID, $TeacherID);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success mt-4'>Record updated successfully.</div>";
            } else {
                echo "<div class='alert alert-danger mt-4'>Error: " . $stmt->error . "</div>";
            }

            $stmt->close();
        }

        if (!empty($row)) {
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?id=" . $id; ?>" class="mt-4">
            <input type="hidden" name="TeacherID" value="<?php echo $row['TeacherID']; ?>">
            <div class="form-group">
                <label for="Name">Name</label>
                <input type="text" class="form-control" id="Name" name="Name" value="<?php echo htmlspecialchars($row['Name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="Address">Address</label>
                <input type="text" class="form-control" id="Address" name="Address" value="<?php echo htmlspecialchars($row['Address']); ?>" required>
            </div>
            <div class="form-group">
                <label for="Phone">Phone</label>
                <input type="text" class="form-control" id="Phone" name="Phone" value="<?php echo htmlspecialchars($row['Phone']); ?>" required>
            </div>
            <div class="form-group">
                <label for="BackgroundCheck">Background Check</label>
                <textarea class="form-control" id="BackgroundCheck" name="BackgroundCheck" required><?php echo htmlspecialchars($row['BackgroundCheck']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="ClassID">Class</label>
                <select class="form-control" id="ClassID" name="ClassID" required>
                    <?php
                    $classResult = $link->query("SELECT ClassID, ClassName FROM Class");
                    while ($class = $classResult->fetch_assoc()) {
                        $selected = ($class["ClassID"] == $row["ClassID"]) ? "selected" : "";
                        echo "<option value='" . $class["ClassID"] . "' $selected>" . htmlspecialchars($class["ClassName"]) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
        <?php
        } else {
            echo "<div class='alert alert-danger mt-4'>No record found for the given ID.</div>";
        }

        $link->close();
        ?>
    </div>
</body>
</html>
