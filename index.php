<?php

if (isset($_POST['usuarios'])) {
    header("Location: public/cadastrar_cliente.php");
    exit;
}

if (isset($_POST['animais'])) {
    header("Location: public/cadastrar_animal.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela inicial</title>
</head>
<body>

    <header><h1>Tela Inicial</h1></header>

    <p>Qual Cadastro você deseja realizar?</p>

    <form method="POST">
        <button type="submit" name="usuarios">
            Usuários
        </button>
    </form>

    <br>

    <form method="POST">
        <button type="submit" name="animais">
            Animais
        </button>
    </form>

</body>
</html>