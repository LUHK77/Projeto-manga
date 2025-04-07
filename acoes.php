<?php

include('db.php');
include('acoesImg.php');

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['cadastrar_manga'])) {

    if (strlen($_POST['titulo']) == 0) {
        header('Location: cadastrar.php');
        $_SESSION['mensagem'] = 'O campo titulo é obrigatorio!';
        exit();
    } elseif (strlen($_POST['autor']) == 0) {
        header('Location: cadastrar.php');
        $_SESSION['mensagem'] = 'O campo autor é obrigatorio!';
        exit();
    } elseif (strlen($_POST['genero']) == 0) {
        header('Location: cadastrar.php');
        $_SESSION['mensagem'] = 'O campo genero é obrigatorio!';
        exit();
    } elseif(strlen($_POST['ano_lancamento']) == 0){
        header('Location: cadastrar.php');
        $_SESSION['mensagem'] = 'O campo Ano de lançamento é obrigatorio!';
        exit();
    } elseif(strlen($_POST['descricao']) == 0){
        header('Location: cadastrar.php');
        $_SESSION['mensagem'] = 'O campo descrição é obrigatorio!';
        exit();
    } else {

        var_dump($_FILES);

        $titulo = ($_POST['titulo']);
        $autor = ($_POST['autor']);
        $genero = ($_POST['genero']);
        $ano_lancamento = ($_POST['ano_lancamento']);
        $descricao = ($_POST['descricao']);
        $imagem = ($_FILES['imagem']);
        $usuario_id = ($_SESSION['id']);
        

        $imagemAprovada = verificarImagem($imagem);
        if($imagemAprovada == "not image"){
        header('Location: cadastrar.php');
        $_SESSION['mensagem'] = 'O arquivo deve ser uma imagem!';
        } else {

        $query = db()->prepare("INSERT INTO mangas (titulo, autor, genero, ano_lancamento, descricao, usuario_id, imagem) 
        VALUES (:titulo, :autor, :genero, :ano_lancamento,:descricao , :usuario_id, :imagem)");
        $manga = $query->execute([
            'titulo' => $titulo,
            'autor' => $autor,
            'genero' => $genero,
            'ano_lancamento' => $ano_lancamento,
            'descricao' => $descricao,
            'usuario_id' => $usuario_id,
            'imagem' => $imagemAprovada
        ]);

        header('Location: geral.php');
     }
   }
}

if (isset($_POST['alterar_manga'])) {

    if (strlen($_POST['titulo']) == 0) {
        header('Location: alterar.php');
        $_SESSION['mensagem'] = 'O campo titulo é obrigatorio!';
        exit();
    } elseif (strlen($_POST['autor']) == 0) {
        header('Location: alterar.php');
        $_SESSION['mensagem'] = 'O campo autor é obrigatorio!';
        exit();
    } elseif (strlen($_POST['genero']) == 0) {
        header('Location: alterar.php');
        $_SESSION['mensagem'] = 'O campo genero é obrigatorio!';
        exit();
    } elseif(strlen($_POST['ano_lancamento']) == 0){
        header('Location: alterar.php');
        $_SESSION['mensagem'] = 'O campo Ano de lançamento é obrigatorio!';
        exit();
    } elseif(strlen($_POST['descricao']) == 0){
        header('Location: alterar.php');
        $_SESSION['mensagem'] = 'O campo descrição é obrigatorio!';
        exit();
    } else {
        $id = ($_POST['id']);
        $titulo = ($_POST['titulo']);
        $autor = ($_POST['autor']);
        $genero = ($_POST['genero']);
        $ano_lancamento = ($_POST['ano_lancamento']);
        $descricao = ($_POST['descricao']);
        $imagem = ($_FILES['imagem']);
        $imagemAprovada = verificarImagem($imagem);
        if($imagemAprovada == "not image"){
        header('Location: alterar.php');
        $_SESSION['mensagem'] = 'O arquivo deve ser uma imagem!';
        } else {
        $query = db()->prepare("UPDATE mangas SET titulo = :titulo, autor = :autor, genero = :genero, 
        ano_lancamento = :ano_lancamento, descricao = :descricao, imagem = :imagem WHERE id = :id;");
        if($query->execute([
            'id' => $id,
            'titulo' => $titulo,
            'autor' => $autor,
            'genero' => $genero,
            'ano_lancamento' => $ano_lancamento,
            'descricao' => $descricao,
            'imagem' => $imagemAprovada
        ])){
            header('Location: listar.php');
        } else {
            $_SESSION['menssagem'] = 'Erro ao alterar o manga!';
            header('Location: alterar.php');
        }
    }
    }
}

if (isset($_POST['deletar_manga'])) {
    // Deleta a imagem na pasta
    $query = db()->prepare('SELECT imagem FROM mangas where id = :id');
    $query->execute([
        'id' => $_POST['id']
    ]);
    $imagem = $query->fetch();
    $img = $imagem['imagem'];
    
    $caminho_arquivo = "./uploadsImg/$img";
    if(!unlink($caminho_arquivo)){
       die('err 404');
    } 
    // Deleta o manga
    $query = db()->prepare("DELETE FROM mangas WHERE id = :id");
    $query->execute([
        'id' => $_POST['id']
    ]);

    header('Location: listar.php');
}


//Ações para o usuario

if (isset($_POST['cadastrar_usuario'])) {

    if (strlen($_POST['nome']) == 0) {
        header('Location: cadastrarUsuario.php');
        $_SESSION['mensagem'] = 'O campo nome é obrigatorio!';
        exit();
    } elseif (strlen($_POST['email']) == 0) {
        header('Location: cadastrarUsuario.php');
        $_SESSION['mensagem'] = 'O campo email é obrigatorio!';
        exit();
    } elseif (strlen($_POST['senha']) == 0) {
        header('Location: cadastrarUsuario.php');
        $_SESSION['mensagem'] = 'O campo senha é obrigatorio!';
        exit();
    } else {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
    
        $hash = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        $query = db()->prepare("INSERT INTO usuarios (nome, email, senha) 
        VALUES (:nome, :email, :senha)");
        $user = $query->execute([
            'nome' => $nome,
            'email' => $email,
            'senha' => $hash
        ]);
        header('Location: index.php');
    }
}

if (isset($_POST['alterar_usuario'])) {

    if (strlen($_POST['nome']) == 0) {
        header('Location: alterarUsuario.php');
        $_SESSION['mensagem'] = 'O campo nome é obrigatorio!';
        exit();
    } elseif (strlen($_POST['email']) == 0) {
        header('Location: alterarUsuario.php');
        $_SESSION['mensagem'] = 'O campo email é obrigatorio!';
        exit();
    } elseif (strlen($_POST['senha']) == 0) {
        header('Location: alterarUsuario.php');
        $_SESSION['mensagem'] = 'O campo senha é obrigatorio!';
        exit();
    } else {
        $id = ($_POST['id']);
        $nome = $_POST['nome'];
        $email = $_POST['email'];
    
        $hash = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        $query = db()->prepare("UPDATE usuarios SET nome = :nome, email = :email, senha = :senha
         WHERE id = :id;");
        $user = $query->execute([
            'id' => $id,
            'nome' => $nome,
            'email' => $email,
            'senha' => $hash
        ]);
        header('Location: geral.php');
    }
}

if (isset($_POST['deletar_usuario'])) {
    // Deleta o usuario
    $query = db()->prepare("DELETE FROM usuarios WHERE id = :id");
    $query->execute([
        'id' => $_POST['id']
    ]);

    header('Location: geral.php');
}

if(isset($_POST['logar_usuario'])){
    if (strlen($_POST['email']) == 0) {
        header('Location: cadastrarUsuario.php');
        $_SESSION['mensagem'] = 'O campo email é obrigatorio!';
        exit();
    } elseif (strlen($_POST['senha']) == 0) {
        header('Location: cadastrarUsuario.php');
        $_SESSION['mensagem'] = 'O campo senha é obrigatorio!';
        exit();
    } else {
        $email = ($_POST['email']);

        $query = db()->prepare("SELECT * FROM usuarios WHERE email = :email");
        $query->execute([
            'email' => $email,
        ]);
        $user = $query->fetch();

        if(password_verify($_POST['senha'],$user['senha'])){
            $_SESSION['id'] = $user['id'];
            $_SESSION['nome'] = $user['nome'];
            $_SESSION['email'] = $user['email'];
            header('Location: geral.php');
        } else {
            $_SESSION['mensagem'] = 'Email ou senha invalidos!';
            header('Location: login.php');
        }
        
    }
}
