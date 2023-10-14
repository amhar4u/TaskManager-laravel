<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Welcome to Task Manager</title>
    <style>
        body {
            background-color:#CBE4F9;
            height: 100vh;
        }

        .center-content {
            text-align: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .image{
             height:200px;
             width:400px; 
        }
        .button{
            width:120px;
        }
    </style>
</head>
<body>

<div class="container h-100">
    <div class="row h-100">
        <div class="col-md-12 center-content">
        <img src="{{url('storage/task.png')}}" alt="" class="img-fluid my-4 image rounded">
            <h1>Welcome to Task Manager</h1>
            <a href="{{ url('login') }}" class="btn btn-primary btn-lg mx-2 button">Login</a>
            <a href="{{ url('registration') }}" class="btn btn-success btn-lg mx-2 button">Register</a>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
