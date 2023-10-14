<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Task Manager</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#" style="margin-left:100px;">Task Manager</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('index') }}" style="color:white;margin-right:10px;">My Tasks</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('newtask') }}" style="color:white;margin-right:10px;">New Task</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="priorityDropdown" role-="button" data-toggle="dropdown" style="color:white;margin-right:50px;">
                    Priority
                </a>
                <div class="dropdown-menu" aria-labelledby="priorityDropdown">
                    <a class="dropdown-item" href="{{ url('index') }}">All</a>
                    <a class="dropdown-item" href="{{ url('high') }}">High</a>
                    <a class="dropdown-item" href="{{ url('low') }}">Low</a>
                    <a class="dropdown-item" href="{{ url('medium') }}">Medium</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="btn btn-light rounded-pill" href="{{ url('logout') }}" style="margin-right:50px;">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container" style="margin-top:50px;">
    @if ($tasks && $tasks->count() > 0)
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Due Date</th>
                <th>Priority</th>
                <th>Status</th>
                <th>Description</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
            @if ($task->priority == 'low')
            <tr class="{{ $task->days < 1 ? 'table-danger' : '' }}">
                <td>{{ $task->id }}</td>
                <td>{{ $task->title }}</td>
                <td>{{ $task->duedate }}</td>
                <td>
                    @if ($task->priority == 'low')
                        <span class="badge badge-success">{{ $task->priority }}</span>
                    @elseif ($task->priority == 'medium')
                        <span class="badge badge-warning">{{ $task->priority }}</span>
                    @else
                        <span class="badge badge-danger">{{ $task->priority }}</span>
                    @endif
                </td>
                <td>
                    @if ($task->status == 'complete')
                        <span class="badge badge-success">{{ $task->status }}</span>
                    @else
                        <span class="badge badge-danger">{{ $task->status }}</span>
                    @endif
                </td>
                <td>{{ $task->description }}</td>
                <td style="height: 30px;">
                    <button class="btn btn-primary btn-sm edit-button" style="width:80px" onclick="">Edit</button>
                </td>
                <td style="height: 30px">   
                    <form action="{{ route('tasks.destroy', ['id' => $task->id]) }}" method="POST">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-danger btn-sm" style="width:80px;">Delete</button>
                    </form>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    @else
    <p style="color:red;text-align:center;font-weight:bold;margin-top:20px;">No Low-priority tasks found.</p>
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>