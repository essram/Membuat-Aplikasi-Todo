<!-- Membuat Aplikasi Todo Membuat Template -->

<?php
//total array yang disiapkan untuk disimpan
$todos    = [];
//melakukan pengecekan apakah file todo.txt ditemukan
if (file_exists('todo.txt')) {
    //membaca file todo.txt
    $file    =    file_get_contents('todo.txt');
    //mengubah format serialize menjadi array
    $todos    =    unserialize($file);
}
//Jika ditemukan todo yang dikirim melalui methode POST
if (isset($_POST['todo'])) {
    $data    = $_POST['todo']; // mengabil data yang di input pada form
    $todos[] = [
        'todo'    => $data,
        'status' => 0
    ];
    $daftar_belanja = serialize($todos);
    file_put_contents('todo.txt', $daftar_belanja);
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
        <?php foreach ($todos as $key => $value) : ?>
            <li>
                <input type="checkbox" name="todo">
                <label for=""><?php echo $value['todo']; ?></label></label>
                <a href="#">Hapus</a>
            </li>
        <?php endforeach ?>
    </ul>
</body>

</html>