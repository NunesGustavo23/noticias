<?php 
# Classes
require_once('inc/classes.php');

//verificar se a página foi requisitada pelo formulário de exclusão
if(isset($_GET['id'])){
    $objCategoria = new Categoria();
    $objCategoria->excluir($_GET['id']);
}
// redirecionar para a pagina notícias
header('location:categorias.php');
?>