<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Library Book - School Management System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Add a Library Book</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="mt-4">
            <div class="form-group">
                <label for="Title">Title</label>
                <input type="text" class="form-control" id="Title" name="Title" required>
            </div>
            <div class="form-group">
                <label for="Author">Author</label>
                <input type="text" class="form-control" id="Author" name="Author" required>
            </div>
            <div class="form-group">
                <label for="ISBN">ISBN</label>
                <input type="text" class="form-control" id="ISBN" name="ISBN" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $servername = "localhost";
            $username = "root";
            $password = "password";
            $dbname = "RishtonAcademyDB";

            $link = new mysqli($servername, $username, $password, $dbname);

            if ($link->connect_error) {
                die("Connection failed: " . $link->connect_error);
            }

            $Title = $link->real_escape_string($_POST['Title']);
            $Author = $link->real_escape_string($_POST['Author']);
            $ISBN = $link->real_escape_string($_POST['ISBN']);

            $stmt = $link->prepare("INSERT INTO LibraryBook (Title, Author, ISBN) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $Title, $Author, $ISBN);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success mt-4'>New record created successfully.</div>";
            } else {
                echo "<div class='alert alert-danger mt-4'>Error: " . $stmt->error . "</div>";
            }

            $stmt->close();
            $link->close();
        }
        ?>
    </div>
</body>
</html>
