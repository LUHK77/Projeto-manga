<?php
include 'db.php';

if (!isset($_SESSION)) {
    session_start();
}

$query = db()->query("SELECT * FROM mangas;");
$mangas = $query->fetchAll();
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
            <h1 class="text-3xl font-semibold text-gray-200 mb-4">Bem-vindo ao Manga Barato</h1>
            <p class="text-xl font-semibold text-gray-200 mb-4">Você pode ver e escolher seus mangas favoritos para armazenar</p>
            <div class="space-y-4">
                <a href="login.php" class="block text-center bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 transition">Entrar</a>
                <a href="cadastrarUsuario.php" class="block text-center bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition">Cadastrar</a>
            </div>
        </div>

        <!-- Grid de Mangas -->
        <h1 class="text-3xl font-semibold text-gray-200 mb-4 mt-8">Mangas Disponiveis</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 mt-6">
            <?php foreach ($mangas as $manga): ?>
                <div class="bg-gray-600 rounded-lg shadow-lg overflow-hidden flex flex-col h-full">
                    <img class="h-56 w-full object-cover m-4" src="uploadsImg/<?php echo $manga['imagem']?>" alt="">
                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-xl font-semibold text-gray-200 mb-2"><?php echo $manga['titulo']; ?></h3>
                        <p class="text-gray-400 text-sm mb-2"><?php echo $manga['genero']; ?></p>
                        <div class="flex-grow">
                            <p class="px-4 py-2 border-b-2 text-white border-gray-500 line-clamp-3" style="word-wrap: break-word;">
                                <?php echo $manga['descricao']; ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</body>
</html>