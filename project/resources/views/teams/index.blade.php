<!DOCTYPE html>
<html>
<head>
    <title>{{ $team->name }} - Команда</title>
</head>
<body>

<h2>{{ $team->name }}</h2>

<h3>Участники команды</h3>
<ul>
    @foreach ($team->employees as $employee)
        <li>{{ $employee->name }}</li>
    @endforeach
</ul>

<h3>Файлы в папке {{ $team->storage_path }}</h3>
<ul>
    @foreach ($files as $file)
        <li>{{ basename($file) }}</li>
    @endforeach
</ul>

</body>
</html>
