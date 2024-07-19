<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>See Parents - School Management System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">See all Parents</h2>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Parent ID</th>
                    <th>Parent Name</th>
                    <th>Parent Address</th>
                    <th>Parent Email</th>
                    <th>Parent Phone</th>
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

                $sql = "SELECT Parent.ParentID, Parent.Name, Parent.Address, Parent.Email, Parent.Phone,
                               GROUP_CONCAT(Pupil.Name SEPARATOR ', ') AS Pupils
                        FROM Parent
                        LEFT JOIN Pupil_Parent ON Parent.ParentID = Pupil_Parent.ParentID
                        LEFT JOIN Pupil ON Pupil_Parent.PupilID = Pupil.PupilID
                        GROUP BY Parent.ParentID";
                $result = $link->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["ParentID"] . "</td>";
                        echo "<td>" . $row["Name"] . "</td>";
                        echo "<td>" . $row["Address"] . "</td>";
                        echo "<td>" . $row["Email"] . "</td>";
                        echo "<td>" . $row["Phone"] . "</td>";
                        echo "<td>" . $row["Pupils"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No parents found</td></tr>";
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
