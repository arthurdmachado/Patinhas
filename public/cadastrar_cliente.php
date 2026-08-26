<?php

include '../infra/conexao.php';

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

    $stmt->close();

    header("Location: cadastrar_cliente.php");
    exit;
}

if (isset($_GET['excluir'])) {

    $id = $_GET['excluir'];

    $sql = "DELETE FROM clientes WHERE id = ?";

    $stmt = $conexao->prepare($sql);

    if (!$stmt) {
        die("Erro ao preparar exclusão: " . $conexao->error);
    }

    $stmt->bind_param("i", $id);

    if (!$stmt->execute()) {
        die("Erro ao excluir usuário: " . $stmt->error);
    }

    $stmt->close();

    header("Location: cadastrar_cliente.php");
    exit;
}

$sql = "SELECT id, nome, email FROM clientes ORDER BY id DESC";

$resultado = $conexao->query($sql);

if (!$resultado) {
    die("Erro ao buscar usuários: " . $conexao->error);
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Clientes</title>
</head>

<body>

    <h1>Cadastrar cliente</h1>

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

    <h2>Usuários cadastrados</h2>

    <table border="1" cellpadding="10">

        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Ações</th>
        </tr>

        <?php while ($usuario = $resultado->fetch_assoc()) { ?>

            <tr>

                <td>
                    <?= htmlspecialchars($usuario['id']) ?>
                </td>

                <td>
                    <?= htmlspecialchars($usuario['nome']) ?>
                </td>

                <td>
                    <?= htmlspecialchars($usuario['email']) ?>
                </td>

                <td>

                    <a href="editar_clientes.php?id=<?= $usuario['id'] ?>">
                        Editar
                    </a>

                    |

                    <a
                        href="cadastrar_cliente.php?excluir=<?= $usuario['id'] ?>"
                        onclick="return confirm('Tem certeza que deseja excluir este usuário?')"
                    >
                        Excluir
                    </a>

                </td>

            </tr>

        <?php } ?>

    </table>

</body>

</html>