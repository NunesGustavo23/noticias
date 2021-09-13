<?php 
# Classes
require_once('inc/classes.php');

// OBJs
$objCategoria = new Categoria();

// verificar se o formulario de cadastro foi postado
if(isset($_POST['btnCadastrar']))
{
    $id_categoria = $objCategoria->cadastrar($_POST);
    header('location:?'.$id_categoria);
} //fecha o if

// verificar se o formulario de atualização foi postado
if(isset($_POST['btnAtualizar']))
{
    $id_categoria = $objCategoria->editar($_POST);
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
                <?php
                if(isset($_GET['id'])&& $_GET['id'] != ''){

                    $cat = $objCategoria->mostrar($_GET['id']);
                ?>
                <!-- FORMULARIO EDITAR -->
                <div id="FormEditar">
                    <form action="?" method="post">
                        <div class="row">
                        <!-- CAMPO OCULTO -->
                        <input type="hidden" name="id_categoria" value="<?php echo $cat->id_categoria?>">
                            <div class="form-group col-md-4">
                                <label for="categoria">Categoria</label>
                                <input class="form-control" type="text" name="categoria" id="categoria" value="<?php echo $cat->categoria?>">   
                            </div>
                            <div class="form-group col-md-4">                                
                               <input class="btn btn-success mt-4" type="submit" value="Atualizar" id="btnAtualizar" name="btnAtualizar"> 
                            </div>                            
                        </div>
                    </form>
                </div>  
                <!-- /FORMULARIO EDITAR-->
                <?php
                }
                else
                {
                ?>

                                <!-- FORMULARIO CADASTRAR -->
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
                <!-- /FORMULARIO CADASTRAR-->
                <?php
                }
                ?>

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
                                <a class="btn btn-dark"   href="?id=<?php echo $categoria->id_categoria; ?>"                                    
                                    title="Editar">
                                    <i class="fas fa-edit"></i> 
                                    Editar 
                                 </a>

                                <!-- BTN EXCLUIR -->
                                <?php if($categoria->id_categoria > 1){ ?>
                                    <button class="btn btn-danger mt-2" 
                                  data-bs-toggle="modal"
                                  data-bs-target="#modalExcluir"
                                  data-identificacao="<?php echo $categoria->categoria; ?>"                                  
                                  data-url="categoria-excluir.php?id=<?php echo $categoria->id_categoria; ?>"
                                  >
                                    <i class="fas fa-trash-alt"></i>
                                    Excluir
                                 </button>
                                 <?php } ?>
                                 <!-- /BTN EXCLUIR -->
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
<!--  MODAL DE EXCLUSÃO -->
<div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="modalExcluirLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="modalExcluirLabel">Exclusão</h5>        
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>              
        
        <div class="modal-body">
          <h2 class="font-weight-bold" id="identificacao"></h2>
              Tem certeza que deseja realizar esta ação?<br> 
              Não será possível desfazê-la posteriormente!
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <a class="btn btn-danger" id="linkExcluir" href=""> Confirmar Exclusão </a>
        </div>
   
    </div>
  </div>
</div>    
<!-- /MODAL DE EXCLUSÃO   -->    
</body>
<!-- JS -->

<?php include_once('../js/meujs.js'); ?>
<!-- SCRIPT MODAL DE EXCLUSÃO  -->
<script>
 // No bootstrap5 o uso do  data-bs-toggle é obrigatório
 
 // https://getbootstrap.com/docs/5.0/components/collapse/
 // .. Em ambos os casos, o data-bs-toggle="collapse"é obrigatório.
  $('#modalExcluir').on('show.bs.modal', function (event) {
    let botaoClicado  = $(event.relatedTarget)   
    let identificacao = botaoClicado.data('identificacao')
    let url           = botaoClicado.data('url')    
    $('#identificacao').text(identificacao)
    $('#linkExcluir').attr('href',url)
  }) ;
</script>
<!-- /SCRIPT MODAL DE EXCLUSÃO -->
</html>