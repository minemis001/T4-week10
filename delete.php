<?php
require_once 'config/database.php';
$id = $_GET['id'] ?? 0;
if ($id) {
    $stmt = $pdo->prepare("DELETE FROM barang WHERE id = :id");
    $stmt->execute([':id' => $id]);
}
header("Location: index.php?status=deleted");
exit;
?>