<?php 

/**
 * Categoria
 */
class Categoria extends Conexao
{
    
    # ATRIBUTOS	
	public $pdo;
    
    public function __construct()
    {
        $this->pdo = Conexao::conexao();               
    }

    /**
     * listar
     * @return array
     */
    public function listar(){
    	//montar o SELECT ou o SQL
    	$sql = $this->pdo->prepare('SELECT * FROM categorias WHERE excluido = 0 ORDER BY categoria');
    	//executar a consulta
    	$sql->execute();
    	//pegar os dados retornados
    	$dados = $sql->fetchAll(PDO::FETCH_OBJ);
    	return $dados;
    }

    /**
     * cadastrar a categoria
     *
     * @param Array $dados
     * @return int 
     */
    public function cadastrar(Array $dados)
    {
        $sql = $this->pdo->prepare('INSERT INTO categorias 
                                    (categoria)
                                    VALUES
                                    (:categoria)
                                    ');
        //mesclar os dados
        $sql->bindParam(':categoria',$dados['categoria']);
        //executar
        $sql->execute();
        return $this->pdo->lastInsertId();
    }

    /**

     * retorna o nome da categoria

     *

     * @param integer $id_categoria

     * @return string

     */

    public static function nomeDaCategoria(int $id_categoria)

    {

        $pdo = Conexao::conexao();

        $sql = $pdo->prepare('SELECT * FROM categorias 

                                    WHERE id_categoria = :id_categoria');

        $sql->bindParam(':id_categoria', $id_categoria);

        $sql->execute();

        $categoria = $sql->fetch(PDO::FETCH_OBJ);

        return $categoria->categoria;

    }

            /**
     * Exclui um determinado categoria
     *
     * @param integer $id_categoria
     * @return void
     */
    public function excluir(int $id_categoria)
    {
        // atualizar todas as noticias dessa categoria para a categoria padrão
        $pdo = $this->pdo->prepare('UPDATE noticias SET
                                id_categoria = 1
                                WHERE
                                id_categoria = :id_categoria
                                AND
                                id_noticia > 0
                                ');
        $pdo->bindParam(':id_categoria', $id_categoria);
        $pdo->execute();


        // excluir a categoria
        // $sql = $this->pdo->prepare('DELETE FROM categorias WHERE id_categoria = :id_categoria');
        $sql = $this->pdo->prepare('UPDATE categorias SET
                                    excluido = 1
                                    WHERE
                                    id_categoria = :id_categoria
        ');
        $sql->bindParam(':id_categoria',$id_categoria);
        $sql->execute();
    }

            /**
     * mostra a categoria
     *
     * @param integer $id_categoria
     * @return object
     */

    public function mostrar(int $id_categoria)
    {
        $sql = $this->pdo->prepare('SELECT * FROM categorias WHERE id_categoria = :id_categoria');
        $sql->bindParam(':id_categoria',$id_categoria);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_OBJ);
    }

    /**
     * editar
     *
     * @param integer $dados
     * @return int
     */
    public function editar(array $dados)
    {
    if($dados['id_categoria'] != '' && isset($dados['id_categoria']) ){

        $sql = $this->pdo->prepare('UPDATE categorias SET
        categoria = :categoria
        WHERE
        id_categoria = :id_categoria
        ');


$sql->bindParam(':id_categoria', $dados['id_categoria']);
$sql->bindParam(':categoria', $dados['categoria']);
$sql->execute();
return $dados['id_catgoria'];
    }
    else
    {
        return false;
    }
    }

}
?>