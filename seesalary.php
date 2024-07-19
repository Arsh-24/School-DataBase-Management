<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>See Salaries - School Management System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">See all Salaries</h2>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Salary ID</th>
                    <th>Amount</th>
                    <th>Employee Type</th>
                    <th>Employee Name</th>
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

                $sql = "SELECT Salary.SalaryID, Salary.Amount, Salary.EmployeeType, 
                               CASE 
                                    WHEN Salary.EmployeeType = 'Teacher' THEN Teacher.Name 
                                    WHEN Salary.EmployeeType = 'TeachingAssistant' THEN TeachingAssistant.Name 
                               END AS EmployeeName
                        FROM Salary
                        LEFT JOIN Teacher ON Salary.EmployeeID = Teacher.TeacherID AND Salary.EmployeeType = 'Teacher'
                        LEFT JOIN TeachingAssistant ON Salary.EmployeeID = TeachingAssistant.AssistantID AND Salary.EmployeeType = 'TeachingAssistant'";
                $result = $link->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["SalaryID"] . "</td>";
                        echo "<td>" . $row["Amount"] . "</td>";
                        echo "<td>" . $row["EmployeeType"] . "</td>";
                        echo "<td>" . $row["EmployeeName"] . "</td>";
                        echo "<td><a href='editsalary.php?id=" . $row["SalaryID"] . "' class='btn btn-warning'>Edit</a> ";
                        echo "<a href='deletesalary.php?id=" . $row["SalaryID"] . "' class='btn btn-danger' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No salaries found</td></tr>";
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
