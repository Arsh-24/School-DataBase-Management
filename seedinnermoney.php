<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>See Dinner Money - School Management System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">See all Dinner Money</h2>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Dinner Money ID</th>
                    <th>Pupil ID</th>
                    <th>Amount</th>
                    <th>Date Paid</th>
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

                $sql = "SELECT * FROM DinnerMoney";
                $result = $link->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["DinnerMoneyID"] . "</td>";
                        echo "<td>" . $row["PupilID"] . "</td>";
                        echo "<td>" . $row["Amount"] . "</td>";
                        echo "<td>" . $row["DatePaid"] . "</td>";
                        echo "<td><a href='editdinnermoney.php?id=" . $row["DinnerMoneyID"] . "' class='btn btn-warning'>Edit</a> ";
                        echo "<a href='deletedinnermoney.php?id=" . $row["DinnerMoneyID"] . "' class='btn btn-danger' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No dinner money records found</td></tr>";
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
