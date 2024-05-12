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
    $data    = $_POST['todo']; // data yang dipilih pada form
    $todos[] = [
        'todo'    => $data,
        'status' => 0
    ];
    $daftar_belanja = serialize($todos);
    file_put_contents('todo.txt', $daftar_belanja);
    //redirect halaman
    header('location:index.php');
}
?>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Todo</title>
    <!-- Sertakan Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center">
    <h1 class="text-3xl font-bold mb-6">Aplikasi Todo</h1>
    <form action="" method="POST" class="mb-4">
        <label class="block mb-2">Apa kegiatanmu hari ini?</label>
        <input type="text" name="todo" class="border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring focus:border-blue-500">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md ml-2 hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Simpan</button>
    </form>
    <ul class="w-full max-w-md">
        <?php foreach ($todos as $key => $value) : ?>
            <li class="flex items-center justify-between border-b border-gray-300 py-2">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="todo" class="form-checkbox border border-gray-300 rounded text-blue-500 focus:ring-2 focus:ring-blue-500">
                    <label><?php echo $value['todo']; ?></label>
                </label>
                <a href="#" class="text-red-500 hover:text-red-600">hapus</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>