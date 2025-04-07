<?php
include 'protect.php';
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
<?php include 'header.php' ?>
    <div class="min-h-screen bg-gray-800 flex flex-col items-center justify-center py-12 px-6">
        <div class="bg-gray-600 rounded-lg shadow-lg p-8 max-w-lg w-full">
            <?php 
                $id = $_GET['id'];
                $query = db()->prepare("SELECT * FROM mangas WHERE id = :id");
                $query->execute([ 'id' => $id]);
                $manga = $query->fetch();
            ?>
            <img class="h-full w-full" src="uploadsImg/<?php echo $manga['imagem']?>" alt="">
            <h1 class="text-4xl font-semibold text-gray-200 mb-4">Informações</h1>
            <!-- Cabeçalho da tabela -->
            <thead class="bg-green-700">
                <h1 class="px-4 py-2 border-b-2 text-white border-gray-500 bg-gray-700">Titulo: <?php echo $manga['titulo']?></h1>
            </thead>
            <label for=""></label>
            <p class="px-4 py-2 border-b-2 text-white  border-gray-500">Autor: <?php echo $manga['autor']?></p>
            <p class="px-4 py-2 border-b-2 text-white  border-gray-500">Genero: <?php echo $manga['genero']?></p>
            <p class="px-4 py-2 border-b-2 text-white  border-gray-500">Ano: <?php echo $manga['ano_lancamento']?></p>
            
            <!-- Descrição com Limite de 3 Linhas -->
             <div class="w-full line-clamp-3">
            <p class="px-4 py-2 border-b-2 text-white border-gray-500 line-clamp-3" style="word-wrap: break-word;">
    <?php echo $manga['descricao'] ?>
</p>
</div>

            <!-- Formulário para Alterar e Deletar -->
            <div class="mt-6 flex justify-between">
                <!-- Formulário Alterar -->
                    <a href="alterar.php?id=<?php echo $manga['id']?>" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Alterar</a>

                <!-- Formulário Deletar -->
                <form action="acoes.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $manga['id']; ?>">
                    <button type="submit" name="deletar_manga" class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600">
                        Deletar
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>