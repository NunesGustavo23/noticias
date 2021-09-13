<?php 
# Classes
require_once('inc/classes.php');
$objAnuncio =  new Anuncio();
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

    <title>Notícias - Anúncios</title>
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
                    <i class="fas fa-comments-dollar"></i>
                    Anúncios 
                    -
                    <a class="btn btn-success" href="anuncio-cadastro.php">
                        <i class="fas fa-plus-square"></i>
                        Novo anúncio
                    </a>              
                </h1>

                <!-- TABELA DE ANUNCIOS -->
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th> Ações</th>
                            <th> Anúncio</th>
                            <th> Dt início</th>                            
                            <th> Dt término</th>                            
                            <th> Qtd Exibições</th>                            
                            <th> URL</th>                           
                        </tr>
                    </thead>
                    <tbody>
                        <!-- ANUNCIOS -->
                        <?php 
                            $anuncios = $objAnuncio->listar();                                                        
                            foreach($anuncios as $anuncio) {                              
                       ?>
                        <tr>
                            <td>
                                <a class="btn btn-dark"   href="anuncio-editar.php?id=<?php echo $anuncio->id_anuncio;?>"                                    
                                    title="Editar">
                                    <i class="fas fa-edit"></i> 
                                    Editar 
                                 </a>

                                 <button class="btn btn-danger mt-2" 
                                  data-bs-toggle="modal"
                                  data-bs-target="#modalExcluir"
                                  data-identificacao="<?php echo $anuncio->anuncio; ?>"                                  
                                  data-url="anuncio-excluir.php?id=<?php echo $anuncio->id_anuncio; ?>"
                                  >
                                    <i class="fas fa-trash-alt"></i>
                                    Excluir
                                 </button>
                                </td>
                                 <td><?php
                                 if($anuncio->anuncio != ''){
                                    echo '<br>';
                                    echo '<img class="img-thumbnail" src="../imagens/anuncios/'.$anuncio->anuncio.'" width="150">';
                                }
                                ?> </td>
                            <td> <?php echo $anuncio->anuncio;  ?></td>                           
                            <td> <?php echo $anuncio->inicio;  ?></td>                          
                            <td> <?php echo $anuncio->termino;  ?></td>                           
                            <td> exibicoes</td>                           
                            <td> <?php echo $anuncio->url;  ?></td>                           
                        </tr>
                        <?php
                            }
                        ?>
                        <!-- /ANUNCIOS -->
                    </tbody>
                </table>
                <!-- /TABELA DE ANUNCIOS -->
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