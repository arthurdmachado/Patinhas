<?php

include '../infra/conexao.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Cliente inválido.");
}

$id = (int) $_GET['id'];

/*
|--------------------------------------------------------------------------
| Atualizar cliente
|--------------------------------------------------------------------------
*/

if (isset($_POST['editar'])) {

    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);

    $sql = "UPDATE clientes SET nome = ?, email = ? WHERE id = ?";

    $stmt = $conexao->prepare($sql);

    if (!$stmt) {
        die("Erro ao preparar atualização: " . $conexao->error);
    }

    $stmt->bind_param("ssi", $nome, $email, $id);

    if (!$stmt->execute()) {
        die("Erro ao atualizar cliente: " . $stmt->error);
    }

    $stmt->close();

    header("Location: cadastrar_cliente.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| Buscar cliente
|--------------------------------------------------------------------------
*/

$sql = "SELECT id, nome, email FROM clientes WHERE id = ?";

$stmt = $conexao->prepare($sql);

if (!$stmt) {
    die("Erro ao preparar consulta: " . $conexao->error);
}

$stmt->bind_param("i", $id);
$stmt->execute();

$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    die("Cliente não encontrado.");
}

$cliente = $resultado->fetch_assoc();

$stmt->close();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Editar Cliente</title>

</head>

<body>

    <h1>Editar cliente</h1>

    <form method="POST">

        <label for="nome">
            Nome:
        </label>

        <br>

        <input
            type="text"
            id="nome"
            name="nome"
            value="<?= htmlspecialchars($cliente['nome']) ?>"
            required
        >

        <br><br>

        <label for="email">
            E-mail:
        </label>

        <br>

        <input
            type="email"
            id="email"
            name="email"
            value="<?= htmlspecialchars($cliente['email']) ?>"
            required
        >

        <br><br>

        <button
            type="submit"
            name="editar"
        >
            Salvar alterações
        </button>

        

    </form>

    <br>

    <a href="cadastrar_cliente.php">
            Cancelar
        </a>

</body>

</html>