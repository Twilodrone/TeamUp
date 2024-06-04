<!DOCTYPE html>
<html>
<head>
    <title>Команда {{ $team->name }}</title>
</head>
<body>
@csrf
<h2>Команда: {{ $team->name }}</h2>

<h3>Участники</h3>
<ul>
    @foreach ($team->employees as $employee)
        <li>{{ $employee->name }}</li>
    @endforeach
</ul>

<h3>Файлы</h3>
<ul>
    @foreach ($files as $file)
        <li>
            {{ basename($file) }}
            <a href="{{ route('teams.download', ['id' => $team->team_id, 'filename' => basename($file)]) }}">Скачать</a>
            <form action="{{ route('teams.deleteFile', ['id' => $team->team_id, 'filename' => basename($file)]) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit">Удалить</button>
            </form>
        </li>
    @endforeach
</ul>

<h3>Загрузить новый файл</h3>
<form action="{{ route('teams.upload', ['id' => $team->team_id]) }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" required>
    <button type="submit">Загрузить</button>
</form>

@if ($errors->any())
    <div>
        <strong>{{ $errors->first() }}</strong>
    </div>
@endif

@if (session('success'))
    <div>
        <strong>{{ session('success') }}</strong>
    </div>
@endif

</body>
</html>
