<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>See Teaching Assistants - School Management System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">See all Teaching Assistants</h2>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Assistant ID</th>
                    <th>Assistant Name</th>
                    <th>Assistant Address</th>
                    <th>Assistant Phone</th>
                    <th>Annual Salary</th>
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

                $sql = "SELECT TeachingAssistant.AssistantID, TeachingAssistant.Name, TeachingAssistant.Address, TeachingAssistant.Phone, Salary.Amount AS AnnualSalary
                        FROM TeachingAssistant
                        LEFT JOIN Salary ON TeachingAssistant.AssistantID = Salary.EmployeeID AND Salary.EmployeeType = 'TeachingAssistant'";
                $result = $link->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["AssistantID"] . "</td>";
                        echo "<td>" . $row["Name"] . "</td>";
                        echo "<td>" . $row["Address"] . "</td>";
                        echo "<td>" . $row["Phone"] . "</td>";
                        echo "<td>" . $row["AnnualSalary"] . "</td>";
                        echo "<td><a href='editassistant.php?id=" . $row["AssistantID"] . "' class='btn btn-warning'>Edit</a> ";
                        echo "<a href='deleteassistant.php?id=" . $row["AssistantID"] . "' class='btn btn-danger' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No teaching assistants found</td></tr>";
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
