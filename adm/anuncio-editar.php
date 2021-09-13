<?php 
# Classes
require_once('inc/classes.php');
$objAnuncio = new Anuncio();

if(isset($_POST['btnEditar'])){
    $id = $objAnuncio->atualizar($_POST,$_FILES['anuncio']);
    header('location:anuncios.php?'.$id);
}

//pegar o id do anuncio que está na URL
$id_anuncio = $_GET['id'];
$anuncio = $objAnuncio->mostrar($id_anuncio);
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
    <title>Anuncios - Editar Anuncio</title>
</head>
<body>
<!-- CONTAINER -->
<div class="container">
 <!-- MENU -->
 <?php include_once('inc/menuAdm.php'); ?>
<!-- /MENU -->
    <!-- CONTEUDO -->
    <div class="row">
        <h1>
            <i class="far fa-newspaper"></i>
                Editar de Anuncios                                
        </h1>    
    
    <form action="?" method="post" enctype="multipart/form-data">
        <!-- CAMPOS OCULTOS -->
        <input type="hidden" name="id_anuncio" value="<?php echo $anuncio->id_anuncio; ?>">
        <!-- foto que a noticia possui -->
        <input type="hidden" name="foto_atual" value="<?php echo $anuncio->anuncio; ?>">
        <!-- CAMPOS OCULTOS -->
        <div class="row">

            <div class="col-md-12 form-group">
                <label class="fw-bolder" for="anuncio">Anuncio</label>
                <input class="form-control" type="file" name="anuncio" id="anuncio"
                ></div>
            <div class="col-md-4 form-group">
                <label class="fw-bolder" for="inicio">Data de Início</label>
                <input class="form-control" type="date" name="inicio" id="inicio" 
                value="<?php echo $anuncio->inicio; ?>" >          
            </div>

            <div class="col-md-4 form-group">
                <label class="fw-bolder" for="termino">Data do Termino</label>
                <input class="form-control" type="date" name="termino" id="termino" 
                value="<?php echo $anuncio->termino; ?>" >             
            </div>

            <div class="col-md-4 form-group">
                <label class="fw-bolder" for="url">URL</label>
                <input class="form-control" type="text" name="url" id="url" 
                value="<?php echo $anuncio->url; ?>" >            
            </div>
            
        </div>
        <div class="col-12 text-end">
        <input class="btn btn-success mt-2 mb-2" type="submit" value="Editar Anuncio" name="btnEditar">    
        </div>

    </form>

    </div>

    <!-- CONTEUDO -->

 <!-- RODAPE -->
 <?php include_once('../inc/rodape.php'); ?>
        <!-- /RODAPE -->
    </div>
<!-- /CONTAINER -->    
</body>
<!-- JS -->
<?php include_once('../js/meujs.js'); ?>
</html>