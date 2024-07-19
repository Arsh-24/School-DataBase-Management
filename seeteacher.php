<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>See Teachers - School Management System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">See all Teachers</h2>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Teacher ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Annual Salary</th>
                    <th>Background Check</th>
                    <th>Class</th>
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

                $sql = "SELECT Teacher.TeacherID, Teacher.Name, Teacher.Address, Teacher.Phone, Salary.Amount AS AnnualSalary, Teacher.BackgroundCheck, Class.ClassName
                        FROM Teacher
                        LEFT JOIN Salary ON Teacher.TeacherID = Salary.EmployeeID AND Salary.EmployeeType = 'Teacher'
                        LEFT JOIN Class ON Teacher.ClassID = Class.ClassID";
                $result = $link->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["TeacherID"] . "</td>";
                        echo "<td>" . $row["Name"] . "</td>";
                        echo "<td>" . $row["Address"] . "</td>";
                        echo "<td>" . $row["Phone"] . "</td>";
                        echo "<td>" . $row["AnnualSalary"] . "</td>";
                        echo "<td>" . $row["BackgroundCheck"] . "</td>";
                        echo "<td>" . $row["ClassName"] . "</td>";
                        echo "<td><a href='editteacher.php?id=" . $row["TeacherID"] . "' class='btn btn-warning'>Edit</a> ";
                        echo "<a href='deleteteacher.php?id=" . $row["TeacherID"] . "' class='btn btn-danger' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No teachers found</td></tr>";
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
