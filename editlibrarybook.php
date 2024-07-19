<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Library Book - School Management System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit a Library Book</h2>
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
            $id = $_GET['id'];
            $result = $link->query("SELECT * FROM LibraryBook WHERE BookID=$id");
            $row = $result->fetch_assoc();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $BookID = $_POST['BookID'];
            $Title = $link->real_escape_string($_POST['Title']);
            $Author = $link->real_escape_string($_POST['Author']);
            $ISBN = $link->real_escape_string($_POST['ISBN']);

            $stmt = $link->prepare("UPDATE LibraryBook SET Title=?, Author=?, ISBN=? WHERE BookID=?");
            $stmt->bind_param("sssi", $Title, $Author, $ISBN, $BookID);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success mt-4'>Record updated successfully.</div>";
            } else {
                echo "<div class='alert alert-danger mt-4'>Error: " . $stmt->error . "</div>";
            }

            $stmt->close();
            $link->close();
        }
        ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="mt-4">
            <input type="hidden" name="BookID" value="<?php echo $row['BookID']; ?>">
            <div class="form-group">
                <label for="Title">Title</label>
                <input type="text" class="form-control" id="Title" name="Title" value="<?php echo $row['Title']; ?>" required>
            </div>
            <div class="form-group">
                <label for="Author">Author</label>
                <input type="text" class="form-control" id="Author" name="Author" value="<?php echo $row['Author']; ?>" required>
            </div>
            <div class="form-group">
                <label for="ISBN">ISBN</label>
                <input type="text" class="form-control" id="ISBN" name="ISBN" value="<?php echo $row['ISBN']; ?>" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
