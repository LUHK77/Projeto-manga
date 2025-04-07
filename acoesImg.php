<?php

function verificarImagem($imagem): string {
    $name = $imagem['name'];
    $tmp_name = $imagem['tmp_name'];

        $extensoa = pathinfo($name, PATHINFO_EXTENSION);
        if ($extensoa != 'png' && $extensoa != 'jpg'  && $extensoa != 'jpeg') {
           return "not image";
        }
        $newName = uniqid() . '.' . $extensoa;
        move_uploaded_file($tmp_name, 'uploadsImg/' . $newName);
        return $newName;
    }

    
