<?php

$senha = password_hash('13123', PASSWORD_DEFAULT);

if($password_verify('123123', $senha)){
    echo "senha valida!";
}else {
    echo "senha incorreta";
}