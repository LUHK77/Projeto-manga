<?php
include 'db.php';
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

    <div class="min-h-screen bg-gray-800 flex flex-col items-center justify-center py-12 px-6">
        <div class="bg-gray-600 rounded-lg shadow-lg p-8 max-w-lg w-full">
            <h1 class="text-3xl font-semibold text-gray-200 mb-4">Lista de Mangas</h1>
            <table class="w-full text-left table-auto border-collapse border-2 border-white">
                <!-- Cabeçalho da tabela -->
                <thead>
                    <tr class="bg-gray-700 text-xl text-gray-200">
                        <th class="px-4 py-2 border-b-2 border-gray-500">Titulo</th>
                        <th class="px-4 py-2 border-b-2 border-gray-500">Autor</th>
                        <th class="px-4 py-2 border-b-2 border-gray-500">Genero</th>
                        <th class="px-4 py-2 border-b-2 border-gray-500">Ano</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $query = db()->prepare("SELECT * FROM mangas");
                    $query->execute();
                    $mangas = $query->fetchAll();
                    ?>
                    <?php foreach($mangas as $manga){ ?>
                    <tr class="bg-gray-600 text-gray-200">
                        <td class="px-4 py-2 border-b-2 border-gray-500"><?php echo $manga['titulo']?></td>
                        <td class="px-4 py-2 border-b-2 border-gray-500"><?php echo $manga['autor']?></td>
                        <td class="px-4 py-2 border-b-2 border-gray-500"><?php echo $manga['genero']?></td>
                        <td class="px-4 py-2 border-b-2 border-gray-500"><?php echo $manga['ano_lancamento']?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>