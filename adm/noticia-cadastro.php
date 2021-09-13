<?php 
# Classes
require_once('inc/classes.php');

# Estanciar OBJ
$objCategoria = new Categoria();

// verificar se o botão cadastrar foi acionado
if( isset($_POST['btnCadastrar'])){
    $objNoticia = new Noticia();
    // print_r($_POST); die(); 
    $id = $objNoticia->cadastrar($_POST,$_FILES['foto']);
    header('location:noticias.php?' .$id);
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

    <title>Notícias</title>
</head>
<body>
<!-- CONTAINER -->
    <div class="container">
        <!-- MENU -->
        <?php include_once('inc/menuAdm.php'); ?>
        <!-- /MENU -->
        <!-- CONTEUDO -->
        <div class="row">
                <h1>Cadastro Notícia</h1>
        </div>
        
        <form action="?" method="post" enctype="multipart/form-data">
         <!-- CAMPO OCULTO -->
         <input type="hidden" name="id_usuario" value="1">
        <!-- /CAMPO OCULTO -->
        <div class="row">

            <div class="col-md-12 form-group">
                <label class="fw-bolder" for="titulo">Título*</label>
                <input class="form-control" type="text" name="titulo" id="titulo" required>
            </div>

            <div class="col-md-12 form-group">
                <label class="fw-bolder" for="foto">Foto</label>
                <input class="form-control" type="file" name="foto" id="foto">
            </div>

            <div class="col-md-12 form-group">
                <label class="fw-bolder" for="foto">Link do Video</label>
                <input class="form-control" type="text" name="video" id="video" >
                <a href=""></a>            
            </div>

            <div class="col-md-4 form-group">
                <label class="fw-bolder" for="subtitulo">Subtitulo:</label>
                <input class="form-control" type="text" name="subtitulo" id="subtitulo">
            </div>
            

            <div class="col-md-4 form-group">
                <label class="fw-bolder" for="id_categoria">Categoria*:</label>
                <select class="form-select" name="id_categoria" id="id_categoria" required>
                    <option value="">Selecione</option>
                    <!-- PEGAR TODAS AS CATEGORIAS CADASTRADAS -->
                    <?php
                        $categorias = $objCategoria->listar();
                        foreach ($categorias as $categoria) {                            
                            echo '<option value="'.$categoria->id_categoria.'">';
                                echo $categoria->categoria;
                            echo '</option>';
                        }
                    ?>
                </select>                
            </div>

            <div class="col-md-12 form-group">
                <label class="fw-bolder" for="conteudo">Conteúdo*:</label>
                <textarea class="form-control" name="conteudo" id="conteudo" cols="30" rows="8" required></textarea>
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