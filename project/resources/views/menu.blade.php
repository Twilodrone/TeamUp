<!DOCTYPE html>
<html>
<head>
    <title>Teams List</title>
</head>
<body>
    <h1>Teams List</h1>

    @if($teams->isEmpty())
        <p>No teams found.</p>
    @else
        <ul>
            @foreach($teams as $team)
                <li>
                    <a href="{{ route('teams.show', $team->team_id) }}">{{ $team->name }}</a>
                </li>
            @endforeach
        </ul>
    @endif
</body>
</html>
