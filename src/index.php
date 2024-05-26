<?php
//total array yang disiapkan untuk disimpan
$todos = [];
//melakukan pengecekan apakah file todo.txt ditemukan
if (file_exists('todo.txt')) {
    //membaca file todo.txt
    $file = file_get_contents('todo.txt');
    //mengubah format serialize menjadi array
    $todos = unserialize($file);
}
//Jika ditemukan todo yang dikirim melalui methode POST
if (isset($_POST['todo'])) {
    $data = $_POST['todo']; // data yang dipilih pada form
    $todos[] = [
        'todo' => $data,
        'status' => 0
    ];
    $daftar_belanja = serialize($todos);
    simpanData($daftar_belanja);
}
//jika ditemukan $_GET['status']
if (isset($_GET['status'])) {
    //ubah status
    $todos[$_GET['key']]['status'] = $_GET['status'];
    $daftar_belanja = serialize($todos);
    simpanData($daftar_belanja);
}
//jika ditemukan perintah hapus / $_GET['hapus']
if (isset($_GET['hapus'])) {
    //hapus data dengan key sesuai yang dipilih
    unset($todos[$_GET['key']]);
    $daftar_belanja = serialize($todos);
    simpanData($daftar_belanja);
}

function simpanData($daftar_belanja)
{
    file_put_contents('todo.txt', $daftar_belanja);
    header('location:index.php');
}
print_r($todos);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo App</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold mb-4 text-center">Todo App</h1>
        <form action="" method="POST" class="mb-4">
            <label class="block text-gray-700 mb-2">Daftar Belanja Hari ini</label>
            <input type="text" name="todo" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 mb-4" placeholder="Masukkan kegiatan...">
            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600">Simpan</button>
        </form>
        <ul class="list-disc pl-5">
            <?php foreach ($todos as $key => $value) : ?>
                <li class="flex items-center justify-between mb-2">
                    <div class="flex items-center">
                        <input type="checkbox" name="todo" class="mr-2" onclick="window.location.href='index.php?status=<?php echo ($value['status'] == 1) ? '0' : '1'; ?>&key=<?php echo $key; ?>'" <?php if ($value['status'] == 1) echo 'checked' ?>>
                        <label class="<?php if ($value['status'] == 1) echo 'line-through'; ?>">
                            <?php echo htmlspecialchars($value['todo']); ?>
                        </label>
                    </div>
                    <a href="index.php?hapus=1&key=<?php echo $key; ?>" class="text-red-600 hover:text-red-800" onclick="return confirm('Apakah Anda Yakin akan menghapus data ini?')">hapus</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>

</html>