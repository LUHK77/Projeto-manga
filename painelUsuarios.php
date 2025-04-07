<?php
include 'db.php';
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
<?php if (isset($_SESSION['mensagem'])) {
                echo '<p class="text-center text-red-500 font-bold mb-4">' . $_SESSION['mensagem'] . '</p>';
                unset($_SESSION['mensagem']);
            } ?>
    <div class="min-h-screen bg-gray-800 flex flex-col items-center justify-center py-12 px-6">
        <div class="bg-gray-600 rounded-lg shadow-lg p-8 max-w-lg w-full">
            <h1 class="text-3xl font-semibold text-gray-200 mb-4">Lista de Usuarios</h1>
            <table class="w-full text-left table-auto border-collapse border-2 border-white">
                <!-- Cabeçalho da tabela -->
                <thead>
                    <tr class="bg-gray-700 text-xl text-gray-200 w-full">
                        <th class="px-4 py-2 border-b-2 border-gray-500">Nome</th>
                        <th class="px-4 py-2 border-b-2 border-gray-500">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $query = db()->query("SELECT * FROM usuarios;");
                    $usuarios = $query->fetchAll();

                    //filtro por nome
                    if(isset($_POST['filtrar_nome'])){
                        if(strlen($_POST['nome']) == 0){
                            $_SESSION['mensagem'] = 'O campo nome esta vazio!';
                            header('Location: painelUsuarios.php');
                        } else {
                            $query = db()->prepare('SELECT * FROM usuarios where nome = :nome');
                            $query->execute([
                                'nome' => $_POST['nome']
                            ]);
                            $usuarios = $query->fetchAll();   
                      }
                    }

                    if($usuarios == null){
                     echo '<td class="text-white px-4 py-2 border-b-2">Nenhum manga cadastrado...</td>';   
                
                    ?>
                    <?php } foreach($usuarios as $usuario){ ?>
                    <tr class="bg-gray-600 text-gray-200 ">
                        <td class="px-4 py-2 border-b-2  border-gray-500"><?php echo $usuario['nome']?></td>
                        <td><a href="confUsuarios.php?id=<?php echo $usuario['id']?>" class="w-70 block text-center bg-blue-600 text-white py-2 px-3 m-2 rounded-md hover:bg-blue-700 transition">Configurações</></a>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <form action="" method="POST">
                <label for="titulo" class="block text-sm font-medium text-white">Filtrar por Nome</label>
                <input type="text" name="nome" id="nome" class="px-4 py-2 border-2 border-gray-300 rounded-md bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                    <button type="submit" name="filtrar_nome" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">
                        Enviar
                    </button>
        </div>
    </div>
    <?php include 'footer.php' ?>
</body>
</html>