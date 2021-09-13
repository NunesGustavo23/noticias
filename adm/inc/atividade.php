<?php 
# Classes
require_once('inc/classes.php');

// OBJs
$objCategoria = new Categoria();

// verificar se o formuario de cadastro foi postado
if(isset($_POST['btnCadastrar']))
{
    $id_categoria = $objCategoria->cadastrar($_POST);
    header('location:?'.$id_categoria);
} //fecha o if

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

    <title>Notícias - Categorias</title>
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
                    <i class="fas fa-align-justify"></i>
                    Categorias               
                </h1>

                <!-- FORMULARIO -->
                <div id="FormCadastro">
                    <form action="?" method="post">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="categoria">Categoria</label>
                                <input class="form-control" type="text" name="categoria" id="categoria">   
                            </div>
                            <div class="form-group col-md-4">                                
                               <input class="btn btn-primary mt-4" type="submit" value="Cadastrar" id="btnCadastrar" name="btnCadastrar"> 
                            </div>                            
                        </div>
                    </form>
                </div>  
                <!-- /FORMULARIO -->

                <!-- TABELA DE CATEGORIAS -->
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th> Ações</th>
                            <th> Categoria</th>
                            <th> Qtd Notícias</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- CATEGORIAS -->
                        <?php
                            $categorias = $objCategoria->listar();
                            foreach ($categorias as $categoria) {                               
                        ?>
                        <tr>
                            <td>
                                <a class="btn btn-dark"   href="#"                                    
                                    title="Editar">
                                    <i class="fas fa-edit"></i> 
                                    Editar 
                                 </a>

                                <a class="btn btn-danger" href="#" 
                                title="Excluir">
                                    <i class="fas fa-trash-alt"></i>
                                    Excluir 
                                </a>
                            </td>
                            <td> <?php echo $categoria->categoria; ?></td>
                            <td> total notícias</td>
                        </tr>
                        <?php
                          } //fecha foreach
                        ?>
                        <!-- /CATEGORIAS -->
                    </tbody>
                </table>
                <!-- /TABELA DE CATEGORIAS -->
        </div>
        <!-- /CONTEUDO -->
        <!-- RODAPE -->
        <?php include_once('../inc/rodape.php'); ?>
        <!-- /RODAPE -->
    </div>
<!-- /CONTAINER -->    
</body>
<!-- JS -->
<?php include_once('../js/meujs.js'); ?>

</html>