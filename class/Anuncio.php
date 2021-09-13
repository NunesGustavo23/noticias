<?php

class Anuncio {

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
    	$sql = $this->pdo->prepare('SELECT * FROM anuncios');
    	//executar a consulta
    	$sql->execute();
    	//pegar os dados retornados
    	$dados = $sql->fetchAll(PDO::FETCH_OBJ);
    	return $dados;
    }

    /**
     * cadastrar um novo anuncio
     *
     * @date 13-07-2021
     * @param Array $dados
     * @param File  $foto_enviada
     * @return int
     * @example $objAnuncio->cadastrar($_POST,$_FILES['foto']);
     * 
     */
    public function cadastrar(Array $dados,  $foto_enviada = null)
    {
        $sql = $this->pdo->prepare('INSERT INTO anuncios 
                                 (anuncio, url, inicio, termino)
                                 values
                                 (:anuncio, :url,:inicio,:termino)
                                 ');
        // TRATAR OS DADOS
        $inicio = $dados['inicio'];
        $termino = $dados['termino'];
        $url = strtolower(trim($dados['url'])) ;
        $anuncio = '';

        // verificar se alguma foto foi enviada 
        // e realizar o upload da imagem
        // verificar se o upload deu certo
        if($foto_enviada){
            $nome_da_foto = Helper::sobeArquivo($foto_enviada,'../imagens/anuncios/');
            //verificar se o upload deu certo
            if($nome_da_foto){
                   $anuncio = $nome_da_foto;
            }
        }

        // mesclar os dados
        $sql->bindParam(':anuncio',$anuncio);
        $sql->bindParam(':url', $url);
        $sql->bindParam(':inicio', $inicio);
        $sql->bindParam(':termino', $termino);
        
        //executar
        $sql->execute();
        return $this->pdo->lastInsertId();
    }


    /**
     * mostrar
     * @param int $id_anuncio
     * @return object
     */
    public function mostrar(int $id_anuncio){
    	//montar o SELECT ou o SQL
    	$sql = $this->pdo->prepare('SELECT * FROM anuncios WHERE id_anuncio = :id_anuncio');
        $sql->bindParam(':id_anuncio', $id_anuncio);
    	//executar a consulta
    	$sql->execute();
    	//pegar os dados retornados
    	$dados = $sql->fetch(PDO::FETCH_OBJ);
    	return $dados;
    }
/**
     * atualiza a anuncio
     *
     * @param array $anuncio
     * @param file $name
     * @return int
     */
    public function atualizar(array $anuncio, $arquivo='')
    {
        
        $pdo = $this->pdo->prepare('UPDATE anuncios SET 
                                    id_anuncio = :id_anuncio,
                                    anuncio = :anuncio,
                                    inicio = :inicio,
                                    termino = :termino,
                                    url = :url
                                    WHERE id_anuncio = :id_anuncio                                    
                                 ');

        // tratar os dados recebidos    
        // $anuncio = '';
        $inicio = trim($anuncio['inicio']);
        $termino  = trim($anuncio['termino']);
        $url  = trim($anuncio['url']);
       
        // fazer o upload da foto, caso tenha sido enviada
        if($arquivo)
        {
            $nome_foto = Helper::sobeArquivo($arquivo,'../imagens/anuncios/');
            //verificar se o arqquivo foi movido parea a pasta imagens
            if($nome_foto)
            {
                $foto = $nome_foto;
            }
            else
            {
                $foto   = $anuncio['foto_atual'];
            }
        }
        else
        {
            $foto   = $anuncio['foto_atual'];

        }

        // mesclar os dados
        $pdo->bindParam(':id_anuncio', $anuncio['id_anuncio']);

        $pdo->bindParam(':anuncio', $foto);
        $pdo->bindParam(':inicio', $inicio);
        $pdo->bindParam(':termino', $termino);
        $pdo->bindParam(':url',$url);
        $pdo->execute();

        return $anuncio['id_anuncio'];  
    }

            /**
     * Exclui um determinado anuncio
     *
     * @param integer $id_anuncio
     * @return void
     */
    public function excluir(int $id_anuncio)
    {
        $sql = $this->pdo->prepare('DELETE FROM anuncios 
                                    WHERE id_anuncio = :id_anuncio');
        $sql->bindParam(':id_anuncio',$id_anuncio);
        $sql->execute();
    }
}

?>