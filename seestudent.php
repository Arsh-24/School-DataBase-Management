<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>See Students - School Management System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">See all Students</h2>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Student Address</th>
                    <th>Medical Information</th>
                    <th>Class</th>
                    <th>Parents</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "password";
                $dbname = "RishtonAcademyDB";

                $link = new mysqli($servername, $username, $password, $dbname);

                if ($link->connect_error) {
                    die("Connection failed: " . $link->connect_error);
                }

                $sql = "SELECT Pupil.PupilID, Pupil.Name, Pupil.Address, Pupil.MedicalInformation, Class.ClassName, 
                               GROUP_CONCAT(Parent.Name SEPARATOR ', ') AS Parents
                        FROM Pupil
                        JOIN Class ON Pupil.ClassID = Class.ClassID
                        LEFT JOIN Pupil_Parent ON Pupil.PupilID = Pupil_Parent.PupilID
                        LEFT JOIN Parent ON Pupil_Parent.ParentID = Parent.ParentID
                        GROUP BY Pupil.PupilID";
                $result = $link->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["PupilID"] . "</td>";
                        echo "<td>" . $row["Name"] . "</td>";
                        echo "<td>" . $row["Address"] . "</td>";
                        echo "<td>" . $row["MedicalInformation"] . "</td>";
                        echo "<td>" . $row["ClassName"] . "</td>";
                        echo "<td>" . $row["Parents"] . "</td>";
                        echo "<td><a href='editstudent.php?id=" . $row["PupilID"] . "' class='btn btn-warning'>Edit</a> ";
                        echo "<a href='deletestudent.php?id=" . $row["PupilID"] . "' class='btn btn-danger' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No students found</td></tr>";
                }

                $link->close();
                ?>
            </tbody>
        </table>

        <div class="mt-4">
            <a href="index.php" class="btn btn-secondary">Home</a>
        </div>
    </div>
</body>
</html>
