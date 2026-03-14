<?php

    $dhost = 'localhost';
    $dUsername = 'root';
    $dPassword = '';
    $dName = 'cadastro';

    $conexao = new mysqli($dhost, $dUsername, $dPassword, $dName);

    //if($conexao -> connect_errno) {   echo "Error";v } else { echo "Conectado";}    
?>