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
            <h1 class="text-3xl font-semibold text-gray-200 mb-4">Cadastre seu manga</h1>
            <?php 
            if (isset($_SESSION['mensagem'])) {
                echo '<p class="text-center text-red-500 font-bold mb-4">' . $_SESSION['mensagem'] . '</p>';
                unset($_SESSION['mensagem']);
            }
            ?>
            <form action="acoes.php" method="POST" class="space-y-4" enctype="multipart/form-data">
            <div>
                    <label for="email" class="block text-sm font-medium text-white">Titulo</label>
                    <input type="text" name="titulo" id="titulo" class="w-full px-4 py-2 border-2 border-gray-300 rounded-md bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                </div>
                <div>
                    <label for="autor" class="block text-sm font-medium text-white">Autor</label>
                    <input type="text" name="autor" id="autor" class="w-full px-4 py-2 border-2 border-gray-300 rounded-md bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                </div>
                <div>
                    <label for="genero" class="block text-sm font-medium text-white">Genero</label>
                    <input type="text" name="genero" id="genero" class="w-full px-4 py-2 border-2 border-gray-300 rounded-md bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                </div>
                <div>
                    <label for="ano_lancamento" class="block text-sm font-medium text-white">Ano de Lançamento</label>
                    <input type="text" name="ano_lancamento" id="ano_lancamento" class="w-full px-4 py-2 border-2 border-gray-300 rounded-md bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                </div>
                <div>
            <label for="descricao"  class="block text-sm font-medium text-white">Descrição</label>
            <textarea rows="6" cols="60" name="descricao" id="descricao" placeholder="Escreva Aqui"  class="w-full px-4 py-2 border-2 border-gray-300 rounded-md bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
            </div>
                <input type="file" name="imagem">
                <div class="space-y-4">
                <button type="submit" name="cadastrar_manga" class="mt-6 block text-center bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 transition w-full">Cadastrar</button>
            </div>
            </form>
        </div>
    </div>
    <?php include 'footer.php' ?>
</body>
</html>