<?php
session_start();
include 'conexao.php';

if (isset($_SESSION['usuario'])) {
    header("Location: criado.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $emailDigitado = $_POST['email'];
    $senhaDigitada = $_POST['senha'];

    if (empty($emailDigitado) || empty($senhaDigitada)) {
        $erro = "Por favor, preencha todos os campos.";
    } else {

        $sql = "SELECT * FROM usuario WHERE email='$emailDigitado' LIMIT 1";
        $resultado = mysqli_query($conn, $sql);

        if ($resultado && mysqli_num_rows($resultado) > 0) {

            $usuario = mysqli_fetch_assoc($resultado);

            // verifica a senha
            if ($usuario['senha'] === $senhaDigitada) {

                // AQUI CORRIGIMOS: salva o CPF na sessão
                $_SESSION['usuario'] = $usuario['cpf'];
                $_SESSION['email'] = $usuario['email'];
                $_SESSION['nome']  = $usuario['nome'];

                header("Location: criado.php");
                exit;

            } else {
                $erro = "Senha incorreta.";
            }

        } else {
            $erro = "Email não encontrado.";
        }
    }
}
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
    background: #f4f6f8;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

.nav {
    width: 100%;
    display: flex;
    justify-content: flex-end;
    padding: 20px 40px;
}

#btn1 {
    background-color: #1e90ff;
    color: white;
    font-size: 1rem;
    padding: 10px 24px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background 0.3s ease;
}
#btn1:hover {
    background-color: #1c7ed6;
}

.message {
    background-color: white;
    margin: auto;
    padding: 60px 40px;
    border-radius: 12px;
    max-width: 420px;
    width: 100%;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
    text-align: center;
}

.message h1 {
    font-size: 2rem;
    color: #333;
    margin-bottom: 24px;
}

.message p {
    font-size: 1rem;
    color: #555;
    margin-top: 12px;
}

#ipt1,
#ipt2 {
    width: 100%;
    height: 44px;
    padding: 0 12px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 1rem;
    margin-bottom: 16px;
    transition: border-color 0.2s ease;
}
#ipt1:focus,
#ipt2:focus {
    border-color: #1e90ff;
    outline: none;
}

#btn2 {
    background-color: #1e90ff;
    color: white;
    font-size: 1.1rem;
    padding: 12px 0;
    width: 100%;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background 0.3s ease;
}
#btn2:hover {
    background-color: #1c7ed6;
}

#a1 {
    display: block;
    margin-top: 20px;
    color: #1e90ff;
    text-decoration: none;
    font-size: 0.95rem;
}
#a1:hover {
    text-decoration: underline;
}

@media (max-width: 500px) {
    .nav {
        padding: 15px 20px;
    }

    .message {
        padding: 40px 20px;
        margin: 30px 16px;
    }
}

    
</style>
<body>
    <div class="nav">
        <button id="btn1" onclick="voltar()">Voltar</button>
    </div>

        <div class="message">
            <form action="login.php" method="POST">
            <h1>Login</h1>
            <input id="ipt1" type="text" name="email" placeholder="Email"> <br><br>
            <input id="ipt2" type="password" name="senha" placeholder="Senha"><br><br>
            <button id="btn2" type="submit">Entrar</button><br><br>
            <a id="a1" href="cadastro.php">Não tem conta? Cadastre-se</a>
           <?php if (isset($erro)) {
    echo "<p style='color:red; margin-top:10px;'>$erro</p>";
}
?>
            </form>
        </div>
    <script>
        function voltar(){
            window.location.href = "index.php";
        }
    </script>
</body>
</html>