<?php 
# Classes
require_once('inc/classes.php');

# Estanciar OBJ
$objAnuncio = new Anuncio();

// verificar se o botão cadastrar foi acionado
if( isset($_POST['btnCadastrar'])){
    $objAnuncio = new Anuncio();
    // print_r($_POST); die(); 
    $id = $objAnuncio->cadastrar($_POST,$_FILES['anuncio']);
    header('location:anuncios.php?' .$id);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <?php  include_once('../inc/css.php'); ?>
    <!-- /CSS -->

    <title>Anuncios</title>
</head>
<body>
<!-- CONTAINER -->
    <div class="container">
        <!-- MENU -->
        <?php include_once('inc/menuAdm.php'); ?>
        <!-- /MENU -->
        <!-- CONTEUDO -->
        <div class="row">
                <h1>Cadastrar Anuncio</h1>
        </div>
        
        <form action="?" method="post" enctype="multipart/form-data">

        <div class="row">

            <div class="col-md-12 form-group">
                <label class="fw-bolder" for="anuncio">Anuncio</label>
                <input class="form-control" type="file" name="anuncio" id="anuncio">
            </div>

            <div class="col-md-4 form-group">
                <label class="fw-bolder" for="inicio">Data de Início</label>
                <input class="form-control" type="date" name="inicio" id="inicio" >           
            </div>

            <div class="col-md-4 form-group">
                <label class="fw-bolder" for="termino">Data do Termino</label>
                <input class="form-control" type="date" name="termino" id="termino" >           
            </div>

            <div class="col-md-4 form-group">
                <label class="fw-bolder" for="url">URL</label>
                <input class="form-control" type="text" name="url" id="url" >           
            </div>

        </div>
        <div class="col-12 text-end">
        <input class="btn btn-success mt-2 mb-2" type="submit" value="Cadastrar" name="btnCadastrar">    
        </div>

    </form>
        <!-- /CONTEUDO -->
        <!-- RODAPE -->
        <?php include_once('../inc/rodape.php'); ?>
        <!-- /RODAPE -->
    </div>
<!-- /CONTAINER -->    
</body>
<!-- JS -->
<?php include_once('../js/meujs.js'); ?>
<!-- /JS -->
</html>