<?php 
# Classes
require_once('inc/classes.php');

//verificar se a página foi requisitada pelo formulário de exclusão
if(isset($_GET['id'])){
    $objAnuncio = new Anuncio();
    $objAnuncio->excluir($_GET['id']);
}
// redirecionar para a pagina anuncios
header('location:anuncios.php');
?>