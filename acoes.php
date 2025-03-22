<?php

include('db.php');

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
    } else {

        $titulo = ($_POST['titulo']);
        $autor = ($_POST['autor']);
        $genero = ($_POST['genero']);
        $ano_lancamento = ($_POST['ano_lancamento']);

        $query = db()->prepare("INSERT INTO mangas (titulo, autor, genero, ano_lancamento) 
        VALUES (:titulo, :autor, :genero, :ano_lancamento)");
        $manga = $query->execute([
            'titulo' => $titulo,
            'autor' => $autor,
            'genero' => $genero,
            'ano_lancamento' => $ano_lancamento
        ]);

        header('Location: index.php');
    }
}

