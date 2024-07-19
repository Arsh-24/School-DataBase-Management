<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>See Classes - School Management System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">See all Classes</h2>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Class ID</th>
                    <th>Class Name</th>
                    <th>Capacity</th>
                    <th>Teacher</th>
                    <th>Pupils</th>
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

                $sql = "SELECT 
                            Class.ClassID, 
                            Class.ClassName, 
                            Class.Capacity, 
                            Teacher.Name AS TeacherName,
                            GROUP_CONCAT(Pupil.Name SEPARATOR ', ') AS Pupils
                        FROM Class
                        LEFT JOIN Teacher ON Class.ClassID = Teacher.ClassID
                        LEFT JOIN Pupil ON Class.ClassID = Pupil.ClassID
                        GROUP BY Class.ClassID, Teacher.Name";
                $result = $link->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["ClassID"] . "</td>";
                        echo "<td>" . $row["ClassName"] . "</td>";
                        echo "<td>" . $row["Capacity"] . "</td>";
                        echo "<td>" . $row["TeacherName"] . "</td>";
                        echo "<td>" . $row["Pupils"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No classes found</td></tr>";
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
