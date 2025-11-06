<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Gerenciador de Usuários</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Usuários</h1>

    <form method="POST">
        <input type="text" name="nome" placeholder="Nome" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit" name="inserir">Inserir</button>
    </form>

    <?php
    // INSERT
    if (isset($_POST['inserir'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $conn->query("INSERT INTO usuarios (nome, email) VALUES ('$nome', '$email')");
    }

    // DELETE
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $conn->query("DELETE FROM usuarios WHERE id = $id");
    }

    // SELECT
    $result = $conn->query("SELECT * FROM usuarios");
    echo "<table><tr><th>ID</th><th>Nome</th><th>Email</th><th>Ações</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['nome']}</td>
                <td>{$row['email']}</td>
                <td><a href='?delete={$row['id']}'>Excluir</a></td>
              </tr>";
    }
    echo "</table>";

    // ALTER (exemplo: adicionar coluna telefone)
    // $conn->query("ALTER TABLE usuarios ADD telefone VARCHAR(20)");
    ?>
</body>
</html>
