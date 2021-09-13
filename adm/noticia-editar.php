<?php 
# Classes
require_once('inc/classes.php');
$objCategoria = new Categoria();
$objNoticia = new Noticia();

if(isset($_POST['btnEditar'])){
    $id = $objNoticia->editar($_POST,$_FILES['foto']);
    header('location:noticias.php?'.$id);
}

//pegar o id da notícia que está na URL
$id_noticia = $_GET['id'];
$noticia = $objNoticia->mostrar($id_noticia);
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
    <title>Notícias - Editar Notícia</title>
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
                Editar de Notícias <?php  echo $noticia->titulo; ?>                                 
        </h1>    
    
    <form action="?" method="post" enctype="multipart/form-data">
        <!-- CAMPOS OCULTOS -->
        <input type="hidden" name="id_usuario" value="<?php echo $noticia->id_usuario; ?>">
        <input type="hidden" name="id_noticia" value="<?php echo $noticia->id_noticia; ?>">
        <!-- foto que a noticia possui -->
        <input type="hidden" name="foto_atual" value="<?php echo $noticia->foto; ?>">
        <!-- CAMPOS OCULTOS -->
        <div class="row">

            <div class="col-md-12 form-group">
                <label class="fw-bolder" for="titulo">Título*</label>
                <input class="form-control" type="text" name="titulo" id="titulo"
                value="<?php echo $noticia->titulo; ?>" 
                required>
            </div>
            <div class="col-md-12 form-group">
                <label class="fw-bolder" for="subtitulo">Subtitulo</label>
                <input class="form-control" type="text" name="subtitulo" id="subtitulo"
                value="<?php echo $noticia->subtitulo; ?>"
                >
            </div>
            <div class="col-md-4 form-group">
                <label class="fw-bolder" for="id_categoria">Categoria*:</label>
                <select class="form-select" name="id_categoria" id="id_categoria" required>
                    <option value="">Selecione</option>
                    <!-- PEGAR TODAS AS CATEGORIAS CADASTRADAS -->
                    <?php
                        $objCategoria = new Categoria();
                        $categorias = $objCategoria->listar();
                        foreach ($categorias as $categoria) {                            
                            echo '<option value="'.$categoria->id_categoria.'">';
                                echo $categoria->categoria;
                            echo '</option>';
                        }
                    ?>
                </select>                
            </div>

            <div class="col-md-4 form-group">
                <label class="fw-bolder" for="foto">Foto</label>
                <input class="form-control" type="file" name="foto" id="foto">
            </div>

            
            <div class="col-md-4 form-group">
                <label class="fw-bolder" for="video">Video (url):</label>
                <input class="form-control" type="text" name="video" id="video"
                value="<?php echo $noticia->video; ?>">
            </div>

            <div class="col-md-12 form-group">
                <label class="fw-bolder" for="conteudo">Conteudo / Notícia:*</label>
                <textarea class="form-control" name="conteudo" id="conteudo" cols="30" rows="4" required></textarea>
            </div>
            
        </div>
        <div class="col-12 text-end">
        <input class="btn btn-success mt-2 mb-2" type="submit" value="Editar Notícia" name="btnEditar">    
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