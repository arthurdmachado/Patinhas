<?php

if (isset($_POST['cadastrar'])) {

    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $sql = "INSERT INTO clientes (nome, email) VALUES (?, ?)";

    $stmt = $conexao->prepare($sql);

    if (!$stmt) {
        die("Erro ao preparar cadastro: " . $conexao->error);
    }

    $stmt->bind_param("ss", $nome, $email);

    if (!$stmt->execute()) {
        die("Erro ao cadastrar usuário: " . $stmt->error);
    }

    header("Location: cadastrar_cliente.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">

        <label for="nome">Nome:</label>

        <input
            type="text"
            id="nome"
            name="nome"
            required
        >

        <br><br>

        <label for="email">E-mail:</label>

        <input
            type="email"
            id="email"
            name="email"
            required
        >

        <br><br>

        <button type="submit" name="cadastrar">
            Cadastrar
        </button>

    </form>
    
</body>
</html>



