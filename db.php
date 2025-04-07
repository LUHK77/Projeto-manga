<?php 

function db(){
    return $db = new PDO('sqlite:banco.sqlite');
}