<?php
require_once("../utils/conn.php");
$resultado = "";

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$itensPorPagina = 5;
$itemInicial = ($page - 1) * $itensPorPagina;

$stmt = $conn->prepare("SELECT * FROM pessoas LIMIT :itemInicial, :itensPorPagina");
$stmt->bindParam(":itemInicial", $itemInicial, PDO::PARAM_INT);
$stmt->bindParam(":itensPorPagina", $itensPorPagina, PDO::PARAM_INT);
$stmt->execute();
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmtTotalItens = $conn->prepare("SELECT COUNT(*) as total FROM pessoas");
$stmtTotalItens->execute();
$todosItens = $stmtTotalItens->fetch(PDO::FETCH_ASSOC)['total'];

$totalPaginas = ceil($todosItens / $itensPorPagina);

$pesquisa = $_POST["pesquisa"];

if ($pesquisa) {
    $stmt = $conn->prepare("SELECT * FROM pessoas WHERE nomecompleto LIKE CONCAT('%', :procurar, '%')");
    $stmt->bindParam(":procurar", $pesquisa);
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Pessoas</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <header>
        <nav class="navbar navbar-expand navbar-light bg-light">
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="/" aria-current="page">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/pessoas/index.php">Pessoas</a>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="container">
            <div class="row">
                <div class="col">
                    <a class="btn btn-success" href="/adicionarpessoa/index.php">Adicionar pessoa</a>
                </div>
            </div>

            <div class="row">
                <form method="POST">
                    <div class="col">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="pesquisa" id="" aria-describedby="helpId" placeholder="procurar pessoa">
                        </div>
                    </div>
                </form>
            </div>

            <div class="row">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table table-primary">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Nome Completo</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultado as $pessoa) : ?>
                                    <tr class="" key="<?= $pessoa["id"] ?>">
                                        <td scope="row"><?= $pessoa["id"] ?></td>
                                        <td scope="row"><?= $pessoa["nomecompleto"] ?></td>
                                        <td>
                                            <a class="btn btn-warning" href="/atualizarpessoa/index.php?id=<?= $pessoa["id"] ?>">Update</a>
                                            <a class="btn btn-danger" href="/deletepessoa/index.php?id=<?= $pessoa["id"] ?>">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <nav aria-label="Page navigation">
                        <ul class="pagination    ">
                            <li class="page-item <?= $page == 1 ? "disabled" : "" ?>">
                                <a class="page-link" href="/pessoas/index.php?=page=<?= $page - 1 ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <label class="page-item">
                                <span class="page-link"><?= $page .  " de "  . $totalPaginas. " - " . $itensPorPagina ?></span>
                            </label>
                            <li class="page-item <?= $page == $totalPaginas ? "disabled" : "" ?>">
                                <a class="page-link" href="/pessoas/index.php?page=<?= $page + 1 ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>