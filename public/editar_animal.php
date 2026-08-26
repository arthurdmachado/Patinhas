<?php

include '../infra/conexao.php';

// Verifica se recebeu o ID do animal
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Animal não encontrado.");
}

$id = $_GET['id'];

// Quando o formulário for enviado
if (isset($_POST['editar'])) {

    $nome = $_POST['nome'];
    $raca = $_POST['raca'];

    $sql = "UPDATE animais SET nome = ?, raca = ? WHERE id = ?";

    $stmt = $conexao->prepare($sql);

    if (!$stmt) {
        die("Erro ao preparar atualização: " . $conexao->error);
    }

    $stmt->bind_param("ssi", $nome, $raca, $id);

    if (!$stmt->execute()) {
        die("Erro ao editar animal: " . $stmt->error);
    }

    $stmt->close();

    // Volta para a página de cadastro
    header("Location: cadastrar_animal.php");
    exit;
}


// Busca os dados atuais do animal
$sql = "SELECT id, nome, raca FROM animais WHERE id = ?";

$stmt = $conexao->prepare($sql);

if (!$stmt) {
    die("Erro ao preparar busca: " . $conexao->error);
}

$stmt->bind_param("i", $id);
$stmt->execute();

$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    die("Animal não encontrado.");
}

$animal = $resultado->fetch_assoc();

$stmt->close();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Animal</title>
</head>

<body>

<h1>Editar Animal</h1>

<form method="POST">

    <label for="nome">Nome:</label>

    <input
        type="text"
        id="nome"
        name="nome"
        value="<?= htmlspecialchars($animal['nome']) ?>"
        required
    >

    <br><br>

    <label for="raca">Raça:</label>

    <input
        type="text"
        id="raca"
        name="raca"
        value="<?= htmlspecialchars($animal['raca']) ?>"
        required
    >

    <br><br>

    <button type="submit" name="editar">
        Salvar alterações
    </button>

</form>

<br>

<a href="cadastrar_animal.php">
    Voltar
</a>

</body>

</html>