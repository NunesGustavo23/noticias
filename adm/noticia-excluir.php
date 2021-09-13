<?php 
# Classes
require_once('inc/classes.php');

//verificar se a página foi requisitada pelo formulário de exclusão
if(isset($_GET['id'])){
    $objNoticia = new Noticia();
    $objNoticia->excluir($_GET['id']);
}
// redirecionar para a pagina notícias
header('location:noticias.php');
?>