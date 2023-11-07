<?php
require_once("../utils/conn.php");
$nomecompleto = $_POST["nomecompleto"];
if($nomecompleto) {
    $stmt = $conn->prepare("INSERT INTO pessoas (nomecompleto) VALUES (:nc)");
    $stmt->bindParam(":nc", $nomecompleto);
    $stmt->execute();
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Adicionar pessoa</title>
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
                    <a class="nav-link active" href="/index.php" aria-current="page">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/pessoas/index.php">Pessoas</a>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="container">
            <form method="POST">
                <div class="mb-3 row">
                    <label for="inputName" class="col-4 col-form-label">Nome</label>
                    <div class="col-8">
                        <input type="text" class="form-control" name="nomecompleto" id="inputName" placeholder="<?= $resultado["nomecompleto"] ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="offset-sm-4 col-sm-8">
                        <button type="submit" class="btn btn-success">Adicionar pessoa</button>
                    </div>
                </div>

            </form>
        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
</body>

</html>