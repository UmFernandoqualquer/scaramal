<?php
$conn = new mysqli("localhost", "root", "", "meubanco");
if ($conn->connect_error) die("Erro: " . $conn->connect_error);

$action = $_REQUEST['action'] ?? '';

if ($action === 'insert') {
    $nome = $_POST['nome'];
    $conn->query("INSERT INTO itens (nome) VALUES ('$nome')");
}
elseif ($action === 'select') {
    $result = $conn->query("SELECT * FROM itens");
    $itens = [];
    while ($row = $result->fetch_assoc()) {
        $itens[] = $row;
    }
    echo json_encode($itens);
}
elseif ($action === 'delete') {
    $id = $_POST['id'];
    $conn->query("DELETE FROM itens WHERE id = $id");
}
?>
