<?php
session_start();
include 'conexao.php';
$usuario = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
$cpf = $_POST['Cpf'];
$nome = $_POST['Nome'];
$telefone = $_POST['Telefone'];
$email = $_POST['Email'];
$senha = $_POST['Senha'];
$cep = $_POST['CEP'];
$rua = $_POST['Rua'];
$numero = $_POST['Numero'];
$complemento = $_POST['Complemento'];
$bairro = $_POST['Bairro'];
$cidade = $_POST['Cidade']; 
$estado = $_POST['Estado'];

$sql = "INSERT INTO `usuario`(`cpf`, `nome`, `telefone`, `email`, `senha`, `cep`, `rua`, `numero`, `complemento`, `bairro`, `cidade`, `estado`)
 VALUES ('$cpf','$nome' , '$telefone', '$email', '$senha', '$cep', '$rua', '$numero', '$complemento', '$bairro', '$cidade','$estado')";

 $resultado = mysqli_query($conn,$sql);

 if($resultado){
    $_SESSION['email'] = $email;
    $_SESSION['senha'] = $senha;
    $_SESSION['nome'] = $nome;
    echo "Usuário cadastrado com sucesso";
 }else{
    echo "Erro ao cadastrar usuário: ".mysqli_error();
 }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
    min-height: 100vh;
    background: #f5b5b5ff;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

.nav {
    width: 100%;
    max-width: 480px;
    display: flex;
    justify-content: flex-start;
    padding: 10px 0 20px 0;
}

#btn1 {
    background-color: transparent;
    border: 2px solid #BB86FC;
    color: #BB86FC;
    font-size: 1.1rem;
    padding: 8px 28px;
    cursor: pointer;
    border-radius: 30px;
    font-weight: 600;
    transition: all 0.3s ease;
}

#btn1:hover {
    background-color: #BB86FC;
    color: #121212;
    box-shadow: 0 0 10px #BB86FC;
    transform: scale(1.05);
}

.message {
    background: #1F1B24;
    border-radius: 20px;
    padding: 40px 50px;
    max-width: 480px;
    width: 100%;
    box-shadow: 0 8px 20px rgba(187, 134, 252, 0.3);
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.message h1 {
    color: #BB86FC;
    font-size: 2.8rem;
    margin-bottom: 30px;
    font-weight: 700;
    letter-spacing: 2px;
}

.ipt {
    width: 100%;
    height: 45px;
    border-radius: 12px;
    border: 2px solid #3A3744;
    padding: 0 15px;
    font-size: 1.1rem;
    color: #E0E0E0;
    background-color: #2C2936;
    margin-bottom: 15px;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

.ipt:focus {
    outline: none;
    border-color: #BB86FC;
    box-shadow: 0 0 8px #BB86FC;
    background-color: #3A3744;
    color: #FFFFFF;
}

#btn2 {
    background: linear-gradient(90deg, #BB86FC 0%, #3700B3 100%);
    color: #FFF;
    font-size: 1.3rem;
    padding: 15px 0;
    cursor: pointer;
    border: none;
    border-radius: 35px;
    width: 100%;
    font-weight: 700;
    box-shadow: 0 6px 15px rgba(187, 134, 252, 0.5);
    transition: background 0.3s ease, transform 0.2s ease;
    margin-top: 10px;
}

#btn2:hover {
    background: linear-gradient(90deg, #3700B3 0%, #BB86FC 100%);
    transform: scale(1.05);
    box-shadow: 0 8px 20px rgba(187, 134, 252, 0.7);
}

#error-msg {
    color: #CF6679;
    font-size: 0.9rem;
    margin-top: -10px;
    margin-bottom: 15px;
    font-weight: 600;
}

#a1 {
    color: #BB86FC;
    font-size: 1.1rem;
    margin-top: 20px;
    text-decoration: none;
    transition: color 0.3s ease;
}

#a1:hover {
    color: #3700B3;
    text-decoration: underline;
}

/* Responsividade */
@media (max-width: 600px) {
    .message {
        padding: 30px 25px;
    }

    .message h1 {
        font-size: 2rem;
    }

    #btn1 {
        font-size: 1rem;
        padding: 6px 20px;
    }
}
</style>
<body>
    <div class="nav">
        <button id="btn1" onclick="voltar()">Voltar</button>
    </div>

        <div class="message">
            <form action="cadastro.php" method="POST">
            <h1>Cadastro</h1>
            <input class="ipt" type="text" id="Cpf" name="Cpf" placeholder="CPF" required><br>
            <input class="ipt" type="text" name="Nome" placeholder="Nome" required><br>
            <input class="ipt" type="text" id="Tel" name="Telefone" placeholder="Telefone" required><br>
            <input class="ipt" type="email" name="Email" placeholder="Email" required> <br>
            <input class="ipt" type="password" name="Senha" placeholder="Senha" required><br>
            <input class="ipt" type="password" name="CSenha" placeholder="Confirmar Senha" required><br>
            <input class="ipt" type="text" id="CEP" name="CEP" placeholder="CEP" required><br>
            <input class="ipt" type="text" name="Rua" placeholder="Rua" required><br>
            <input class="ipt" type="text" name="Numero" placeholder="Numero" required><br>
            <input class="ipt" type="text" name="Complemento" placeholder="Complemento" required><br>
            <input class="ipt" type="text" name="Bairro" placeholder="Bairro" required><br>
            <input class="ipt" type="text" name="Cidade" placeholder="Cidade" required><br>
            <input class="ipt" type="text" id="Est" name="Estado" placeholder="Estado" required><br>
            <button id="btn2" type="submit">Cadastrar</button><br>
            <a id="a1" href="login.php">Já tem uma conta? Logue-se</a>
            </form>
        </div>
    <script src="https://unpkg.com/inputmask@5.0.8/dist/inputmask.min.js"></script>
    <script>
        function voltar(){
            window.location.href = "login.php";
        }
        Inputmask("999.999.999-99").mask(document.querySelector("#Cpf"));
        Inputmask("(99) 99999-9999").mask(document.querySelector("#Tel"));
        Inputmask("99999999").mask(document.querySelector("#CEP"));
        Inputmask("AA").mask(document.querySelector("#Est"));

        const senhaInput = document.querySelector('input[name="Senha"]');
    const csenhaInput = document.querySelector('input[name="CSenha"]');

    // Cria elemento de mensagem de erro (se ainda não existir)
    const erroSpan = document.createElement('span');
    erroSpan.style.color = 'red';
    erroSpan.style.fontSize = '14px';
    erroSpan.style.display = 'none'; // invisível até mostrar erro
    csenhaInput.parentNode.insertBefore(erroSpan, csenhaInput.nextSibling);

    function validarSenhas() {
        const senha = senhaInput.value;
        const csenha = csenhaInput.value;

        if (csenha.length > 0 && senha !== csenha) {
            csenhaInput.style.borderColor = 'red';
            erroSpan.textContent = 'As senhas não coincidem.';
            erroSpan.style.display = 'block';
        } else {
            csenhaInput.style.borderColor = '';
            erroSpan.textContent = '';
            erroSpan.style.display = 'none';
        }
    }

    csenhaInput.addEventListener('input', validarSenhas);
    senhaInput.addEventListener('input', validarSenhas);
        
    </script>
</body>
</html>