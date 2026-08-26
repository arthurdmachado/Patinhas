<?php

include '../infra/conexao.php';

if (isset($_POST['cadastrar'])) {

    $nome = $_POST['nome'];
    $raca = $_POST['raca'];

    $sql = "INSERT INTO animais (nome, raca) VALUES (?, ?)";

    $stmt = $conexao->prepare($sql);

    if (!$stmt) {
        die("Erro ao preparar cadastro: " . $conexao->error);
    }

    $stmt->bind_param("ss", $nome, $raca);

    if (!$stmt->execute()) {
        die("Erro ao cadastrar animal: " . $stmt->error);
    }

    $stmt->close();

    header("Location: cadastrar_animal.php");
    exit;
}

if (isset($_GET['excluir'])) {

    $id = $_GET['excluir'];

    $sql = "DELETE FROM animais WHERE id = ?";

    $stmt = $conexao->prepare($sql);

    if (!$stmt) {
        die("Erro ao preparar exclusão: " . $conexao->error);
    }

    $stmt->bind_param("i", $id);

    if (!$stmt->execute()) {
        die("Erro ao excluir animal: " . $stmt->error);
    }

    $stmt->close();

    header("Location: cadastrar_animal.php");
    exit;
}

$sql = "SELECT id, nome, raca, clientes_id FROM animais ORDER BY id DESC";

$resultado = $conexao->query($sql);

if (!$resultado) {
    die("Erro ao buscar animais: " . $conexao->error);
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Animal</title>
</head>

<body>

<h1>Cadastrar Animal</h1>

<form method="POST">

    <label for="nome">Nome:</label>

    <input
        type="text"
        id="nome"
        name="nome"
        required
    >

    <br><br>

    <label for="raca">Raça:</label>

    <input
        type="text"
        id="raca"
        name="raca"
        required
    >

    <br><br>

    <button type="submit" name="cadastrar">
        Cadastrar
    </button>

</form>

<h2>Animais cadastrados</h2>

<table border="1" cellpadding="10">

    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Raça</th>
        <th>ID Dono</th>
        <th>Ações</th>
    </tr>

    <?php while ($animal = $resultado->fetch_assoc()) { ?>

        <tr>

            <td>
                <?= htmlspecialchars($animal['id']) ?>
            </td>

            <td>
                <?= htmlspecialchars($animal['nome']) ?>
            </td>

            <td>
                <?= htmlspecialchars($animal['raca']) ?>
            </td>

            <td>
                <?= htmlspecialchars($animal['clientes_id']) ?>
            </td>

            <td>

                <a href="editar_animal.php?id=<?= $animal['id'] ?>">
                    Editar
                </a>

                |

                <a
                    href="cadastrar_animal.php?excluir=<?= $animal['id'] ?>"
                    onclick="return confirm('Tem certeza que deseja excluir este animal?')"
                >
                    Excluir
                </a>

            </td>

        </tr>

    <?php } ?>

</table>

</body>

</html>