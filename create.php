

<?php
require 'banco.php';
//Acompanha os erros de validação

// Processar so quando tenha uma chamada post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipoErro = null;
    $cantorErro = null;
    $descricaoErro = null;

    if (!empty($_POST)) {
        $validacao = True;
        $novoUsuario = False;
        if (!empty($_POST['tipo'])) {
            $tipo = $_POST['tipo'];
        } else {
            $tipoErro = 'Por favor digite o tipo!';
            $validacao = False;
        }


        if (!empty($_POST['cantor'])) {
            $cantor = $_POST['cantor'];
        } else {
            $cantorErro = 'Por favor digite o nome do cantor!';
            $validacao = False;
        }


        if (!empty($_POST['descricao'])) {
            $descricao = $_POST['descricao'];
        } else {
            $descricaoErro = 'Por favor digite uma descrição!';
            $validacao = False;
        }        
    }

//Inserindo no Banco:
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO discos (tipo, cantor, descricao) VALUES(?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($tipo, $cantor, $descricao));
        Banco::desconectar();
        header("Location: index.php");
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Adicionar Discos</title>
</head>

<body>
<div class="container">
    <div clas="span10 offset1">
        <div class="card">
            <div class="card-header">
                <h3 class="well"> Adicionar Discos </h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="create.php" method="post">

                    <div class="control-group  <?php echo !empty($tipoErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Tipo</label>
                        <div class="controls">
                            <input size="50" class="form-control" name="tipo" type="text" placeholder="Tipo"
                                   value="<?php echo !empty($tipo) ? $tipo : ''; ?>">
                            <?php if (!empty($tipoErro)): ?>
                                <span class="text-danger"><?php echo $tipoErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($cantorErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Cantor</label>
                        <div class="controls">
                            <input size="80" class="form-control" name="cantor" type="text" placeholder="Cantor"
                                   value="<?php echo !empty($endereco) ? $endereco : ''; ?>">
                            <?php if (!empty($cantorErro)): ?>
                                <span class="text-danger"><?php echo $cantorErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($descricaoErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Descrição</label>
                        <div class="controls">
                            <input size="35" class="form-control" name="descricao" type="text" placeholder="Descricao"
                                   value="<?php echo !empty($descricao) ? $descricao : ''; ?>">
                            <?php if (!empty($telefoneErro)): ?>
                                <span class="text-danger"><?php echo $descricaoErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-actions">
                        <br/>
                        <button type="submit" class="btn btn-success">Adicionar</button>
                        <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                    </div>
                </form>
            </div>
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

