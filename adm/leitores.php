<?php 
# Classes
require_once('inc/classes.php');
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

    <title>Notícias - Leitores</title>
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
                    <i class="fas fa-user-tag"></i>
                    Leitores
                </h1>

                <!-- TABELA DE LEITORES -->
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th> Ações</th>
                            <th> Nome</th>                            
                            <th> Contatos</th>                            
                            <th> Qtd Comentários</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- LEITORES -->
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
                            <td> nome</td>                            
                            <td> contatos</td>                            
                            <td> total comentarios</td>
                        </tr>
                        <!-- /LEITORES -->
                    </tbody>
                </table>
                <!-- /TABELA DE LEITORES -->
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