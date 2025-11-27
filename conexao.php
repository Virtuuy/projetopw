<?php
//Dados de conexão
$host='localhost';
$user = 'root';
$senha = '';
$banco = 'virtu_bd';

//tentar conectar
$conn = mysqli_connect($host, $user, $senha, $banco);

//verificar a conexão

if($conn == true){
    //echo "Conectado com sucesso!";
}else{
    die("Erro de conexão: ".mysqli_connect_error());
}
/*
    CREATE TABLE usuario(
	cpf char(11) not null,
    nome varchar(100) not null,
    telefone varchar(15) not null,
    email varchar(100) unique not null,
    senha varchar(100) not null,
    cep char(8) not null,
    rua varchar(100) not null, 
    numero varchar(10) not null,
    complemento varchar(30),
    bairro varchar(50) not null,
    cidade varchar(50) not null,
    estado char(2) not null,
    PRIMARY KEY(cpf)
);
*/
?>