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

    <title>Notícias - Administradores</title>
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
                    <i class="fas fa-user-friends"></i>
                    Administradores 
                    -
                    <a class="btn btn-success" href="#">
                        <i class="fas fa-plus-square"></i>
                        Novo(a) administrador(a)
                    </a>              
                </h1>
                
                <!-- TABELA DE AUTORES -->
                <table class="table table-striped table-hover">                
                    <thead>
                        <tr>
                            <th> Ações</th>
                            <th> Nome</th>                            
                            <th> Contatos</th>                           
                        </tr>
                    </thead>
                    <tbody>
                        <!-- AUTORES -->
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
                        </tr>
                        <!-- /AUTORES -->
                    </tbody>
                </table>
                <!-- /TABELA DE AUTORES -->
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