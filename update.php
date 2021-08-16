<?php

require 'banco.php';

$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (null == $id) {
    header("Location: index.php");
}

if (!empty($_POST)) {

    $tipoErro = null;
    $cantorErro = null;
    $descricaoErro = null;

    $tipo = $_POST['tipo'];
    $cantor = $_POST['cantor'];
    $descricao = $_POST['descricao'];

    //Validação
    $validacao = true;
    if (empty($tipo)) {
        $tipoErro = 'Por favor digite o tipo!';
        $validacao = false;
    }

    if (empty($cantor)) {
        $cantorErro = 'Por favor digite canto!';
        $validacao = false;
    } else if (!filter_var($cantor, FILTER_SANITIZE_STRING)) {
        $cantorErro = 'Por favor digite cantor!';
        $validacao = false;
    }

    if (empty($descricao)) {
        $descricaoErro = 'Por favor digite uma descricao';
        $validacao = false;
    }

    // update data
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE discos  set tipo = ?, cantor = ?, descricao = ? WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($tipo, $cantor, $descricao, $id));
        Banco::desconectar();
        header("Location: index.php");
    }
} else {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM discos where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $tipo = $data['tipo'];
    $cantor = $data['cantor'];
    $descricao = $data['descricao'];
    Banco::desconectar();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- using new bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Atualizar Discos</title>
</head>

<body>
<div class="container">

    <div class="span10 offset1">
        <div class="card">
            <div class="card-header">
                <h3 class="well"> Atualizar Discos </h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="update.php?id=<?php echo $id ?>" method="post">

                    <div class="control-group <?php echo !empty($tipoErro) ? 'error' : ''; ?>">
                        <label class="control-label">Tipo</label>
                        <div class="controls">
                            <input name="tipo" class="form-control" size="50" type="text" placeholder="Tipo"
                                   value="<?php echo !empty($tipo) ? $tipo : ''; ?>">
                            <?php if (!empty($tipoErro)): ?>
                                <span class="text-danger"><?php echo $tipoErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($cantorErro) ? 'error' : ''; ?>">
                        <label class="control-label">Cantor</label>
                        <div class="controls">
                            <input name="cantor" class="form-control" size="80" type="text" placeholder="Cantor"
                                   value="<?php echo !empty($cantor) ? $cantor : ''; ?>">
                            <?php if (!empty($cantorErro)): ?>
                                <span class="text-danger"><?php echo $cantorErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($descricaoErro) ? 'error' : ''; ?>">
                        <label class="control-label">descricao</label>
                        <div class="controls">
                            <input name="descricao" class="form-control" size="30" type="text" placeholder="Descrição"
                                   value="<?php echo !empty($descricao) ? $descricao : ''; ?>">
                            <?php if (!empty($descricaoErro)): ?>
                                <span class="text-danger"><?php echo $descricaoErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    
                    </div>

                    <br/>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-warning">Atualizar</button>
                        <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="assets/js/bootstrap.min.js"></script>
</body>

</html>
