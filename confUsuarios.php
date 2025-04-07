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
                $query = db()->prepare("SELECT * FROM usuarios WHERE id = :id");
                $query->execute([ 'id' => $id]);
                $usuario = $query->fetch();
            ?>
            <h1 class="text-4xl font-semibold text-gray-200 mb-4">Informações</h1>
            <!-- Cabeçalho da tabela -->
            <thead class="bg-green-700">
                <h1 class="px-4 py-2 border-b-2 text-white border-gray-500 bg-gray-700">Nome: <?php echo $usuario['nome']?></h1>
            </thead>
            <label for=""></label>
            <p class="px-4 py-2 border-b-2 text-white  border-gray-500">Email: <?php echo $usuario['email']?></p>
            <p class="px-4 py-2 border-b-2 text-white  border-gray-500">Senha: <?php echo $usuario['senha']?></p>
            

            <!-- Formulário para Alterar -->
            <div class="mt-6 flex justify-between">
                <!-- Formulário Alterar -->
                    <a href="alterarUsuario.php?id=<?php echo $usuario['id']?>" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Alterar</a>

                <!-- Formulário Deletar -->
                <form action="acoes.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
                    <button type="submit" name="deletar_usuario" class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600">
                        Deletar
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>