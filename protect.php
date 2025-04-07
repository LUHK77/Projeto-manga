<?php

if(!isset($_SESSION)){
    session_start();
}

if(!isset($_SESSION['id'])){
    die('Voce não pode estar aqui sem estar logado!');
}