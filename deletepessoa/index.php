<?php
    require_once("../utils/conn.php");
    $id = $_GET["id"];
    $stmt = $conn->prepare("DELETE FROM pessoas WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    header("Location: /pessoas/index.php");
?>