<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f7f7;
        }
        .hero {
            background: url('p.jpg') no-repeat center center;
            background-size: cover;
            height: 50vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: black;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(255, 255, 255, 0.7);
            animation: fadeIn 2s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .hero h1 {
            font-size: 3em;
        }
        .card {
            margin-top: 20px;
        }
        .content {
            margin-top: 20px; /* Reduced gap */
        }
        footer {
            background-color: #f8f9fa;
            padding: 10px 0;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">School Management System</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        </ul>
    </div>
</nav>

<div class="hero">
    <h1>Welcome to our School Management System</h1>
</div>

<div class="container content">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Students</h5>
                    <a href="addstudent.php" class="btn btn-primary btn-block">Add a Student</a>
                    <a href="seestudent.php" class="btn btn-success btn-block">See all Students</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Parents</h5>
                    <a href="addparent.php" class="btn btn-primary btn-block">Add a Parent</a>
                    <a href="seeparent.php" class="btn btn-success btn-block">See all Parents</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Teachers</h5>
                    <a href="addteacher.php" class="btn btn-primary btn-block">Add a Teacher</a>
                    <a href="seeteacher.php" class="btn btn-success btn-block">See all Teachers</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Classes</h5>
                    <a href="seeclass.php" class="btn btn-success btn-block">See all Classes</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Teaching Assistants</h5>
                    <a href="addassistant.php" class="btn btn-primary btn-block">Add a Teaching Assistant</a>
                    <a href="seeassistant.php" class="btn btn-success btn-block">See all Teaching Assistants</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Salaries</h5>
                    <a href="addsalary.php" class="btn btn-primary btn-block">Add Salary</a>
                    <a href="seesalary.php" class="btn btn-success btn-block">See all Salaries</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Dinner Money</h5>
                    <a href="adddinnermoney.php" class="btn btn-primary btn-block">Add Dinner Money</a>
                    <a href="seedinnermoney.php" class="btn btn-success btn-block">See all Dinner Money</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Library Books</h5>
                    <a href="addlibrarybook.php" class="btn btn-primary btn-block">Add a Library Book</a>
                    <a href="seelibrarybook.php" class="btn btn-success btn-block">See all Library Books</a>
                </div>
            </div>
        </div>
    </div>
</div>

<footer>
    <p>&copy; 2024 School Management System. All Rights Reserved.</p>
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
