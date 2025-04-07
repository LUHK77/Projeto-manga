<?php

include 'protect.php';

if (!isset($_SESSION)) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo</title>
    <!-- Incluindo o TailwindCSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans antialiased">
    <?php include 'header.php' ?>

    <div class="min-h-screen bg-gray-800 flex flex-col items-center justify-center py-12 px-6">
        <div class="bg-gray-600 rounded-lg shadow-lg p-8 max-w-lg w-full">
            <h1 class="text-3xl font-semibold text-gray-200 mb-4">Bem-vindo ao Manga Barato</h1>

            <div class="space-y-4">
                <a href="cadastrar.php" class="block text-center bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 transition">Cadastrar um manga</a>
                <a href="listar.php" class="block text-center bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition">Listar Mangas</a>
            </div>
        </div>
    </div>
 <?php include 'footer.php' ?>
</body>
</html>