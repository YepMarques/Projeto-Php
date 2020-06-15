<?php
session_start();
$nome_servidor = "localhost";
$nome_usuario = "root";
$senha = "";
$nome_banco = "meu banco";


// Criar conexão
$conecta = new mysqli($nome_servidor, $nome_usuario, $senha, $nome_banco);
// Verificar Conexão
if ($conecta->connect_error) {
    die("Conexão falhou: " . $conecta->connect_error . "<br>");
}
echo "";
$nomeUsuario = isset($_POST['nome'])?$_POST['nome']:"";
$email = isset($_POST['email'])?$_POST['email']:"";
$senha = isset($_POST['senha'])?$_POST['senha']:"";

$tenta_achar = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha' AND nome='$nomeUsuario' ";
$resultado = $conecta->query($tenta_achar);
if ($resultado->num_rows > 0) {
    $_SESSION['nome'] = $nomeUsuario;
    $_SESSION['email'] = $email;
    $_SESSION['senha'] = $senha;
    header('location:index.html');
} else {
    session_unset(); //remove todas as variáveis de sessão
    session_destroy();
    echo "<script> 
                alert('Login ou senha incorreto');
                window.location.href = 'indexLogin.html';
           </script>";
}
$conecta->close();
?>