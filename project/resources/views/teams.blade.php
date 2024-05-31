<!DOCTYPE html>
<html>
<head>
    <title>{{ $team->name }} - Team Details</title>
</head>
<body>
    <h1>{{ $team->name }}</h1>

    <h2>Participants</h2>
    @if($team->employees->isEmpty())
        <p>No participants found in this team.</p>
    @else
        <ul>
            @foreach($team->employees as $employee)
                <li>{{ $employee->name }} ({{ $employee->email }})</li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('team') }}">Back to Teams List</a>
</body>
</html>
