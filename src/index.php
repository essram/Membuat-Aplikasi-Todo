<!-- Membuat Aplikasi Todo Membuat Template -->

<?php
$todos = [];
if (isset($_post['todo'])) {
    $data = $_post['todo'];
    $todos[] = [
        'todo' => $data,
        'status' => 0
    ];
    file_put_contents('todo.txt', serialize($todos));

    $file = file_get_contents('todo.txt');
    $todos = unserialize($file);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To do App</title>
</head>

<body>
    <h1>
        Todo App
    </h1>

    <form method="post">
        <label for="">Apa kegiatanmu Hari Ini?</label> <br>
        <input type="text" name="todo">
        <button type="submit">Simpan</button>
    </form>

    <ul>
        <li>
            <input type="checkbox" name="todo">
            <label for="">Todo 1</label>
            <a href="#">Hapus</a>
        </li>
        <li>
            <input type="checkbox" name="todo">
            <label for="">Todo 1</label>
            <a href="#">Hapus</a>
        </li>
        <li>
            <input type="checkbox" name="todo">
            <label for="">Todo 1</label>
            <a href="#">Hapus</a>
        </li>
    </ul>
</body>

</html>