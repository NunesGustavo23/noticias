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

    <title>Notícias - Área administrativa</title>
</head>
<body>
<!-- CONTAINER -->
    <div class="container">

        <!-- CONTEUDO -->
        <div class="row">
        <h2 class="text-center mt-5">Área de Acesso Restrito</h2>
        <div class="col-md-3">&nbsp;</div>                
        <form action="?" method="post" class="mt-5 border border-secondary rounded col-md-6">       
            <div class="form-row mt-2">
                <label class="fw-bold" for="login">Login / E-mail</label>
                <input class="form-control" type="text" name="login" id="login" required>
            </div>                    
            <div class="form-row mt-2">
                <label class="fw-bold" for="senha">Senha</label>
                <input class="form-control" type="password" name="senha" id="senha">
            </div>                    
            <div class="form-row mt-3 mb-3 text-end">
                <input class="btn btn-primary" type="submit" value="Realizar Login" id="btnLogar" name="btnLogar">
            </div>
        </form>  
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
<!-- /JS -->
</html>