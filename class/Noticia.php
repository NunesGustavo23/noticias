<?php

class Noticia {

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
    	$sql = $this->pdo->prepare('SELECT * FROM noticias ORDER BY data');
    	//executar a consulta
    	$sql->execute();
    	//pegar os dados retornados
    	$dados = $sql->fetchAll(PDO::FETCH_OBJ);
    	return $dados;
    }

    /**
     * cadastrar uma nova notícia
     *
     * @date 17-06-2021
     * @param Array $dados
     * @param File  $foto_enviada
     * @return int
     * @example $objNoticia->cadastrar($_POST,$_FILES['foto']);
     * 
     */
    public function cadastrar(Array $dados,  $foto_enviada = null)
    {
        $sql = $this->pdo->prepare('INSERT INTO noticias 
                                 (id_categoria, id_usuario, data,titulo, conteudo, subtitulo, foto, video)
                                 values
                                 (:id_categoria, :id_usuario,:data,:titulo,:conteudo, :subtitulo, :foto, :video)
                                 ');
        // TRATAR OS DADOS
        $data = date('Y-m-d H:i:s');
        $id_categoria   = $dados['id_categoria'];
        $id_usuario     = $dados['id_usuario'];
        $conteudo       = $dados['conteudo'];
        $titulo         = ucfirst(strtolower(trim($dados['titulo']))) ;
        $subtitulo      = ucfirst(strtolower(trim($dados['subtitulo'])));
        $video          = trim($dados['video']);
        $foto           = '';

        // verificar se alguma foto foi enviada 
        // e realizar o upload da imagem
        // verificar sew o upload deu certo
        if($foto_enviada){
            $nome_da_foto = Helper::sobeArquivo($foto_enviada,'../imagens/noticias/');
            //verificar se o upload deu certo
            if($nome_da_foto){
                   $foto = $nome_da_foto;
            }
        }

        // mesclar os dados

        $sql->bindParam(':id_categoria',$id_categoria);
        $sql->bindParam(':id_usuario', $id_usuario);
        $sql->bindParam(':data',$data);
        $sql->bindParam(':conteudo',$conteudo);
        $sql->bindParam(':titulo',$titulo);
        $sql->bindParam(':subtitulo',$subtitulo);
        $sql->bindParam(':foto',$foto);
        $sql->bindParam(':video',$video);

        //executar
        $sql->execute();
        return $this->pdo->lastInsertId();
    }


    /**
     * mostrar
     * @param int $id_noticia
     * @return object
     */
    public function mostrar(int $id_noticia){
    	//montar o SELECT ou o SQL
    	$sql = $this->pdo->prepare('SELECT * FROM noticias WHERE id_noticia = :id_noticia');
        $sql->bindParam(':id_noticia', $id_noticia);
    	//executar a consulta
    	$sql->execute();
    	//pegar os dados retornados
    	$dados = $sql->fetch(PDO::FETCH_OBJ);
    	return $dados;
    }
/**
     * atualiza a noticia
     *
     * @param array $noticia
     * @param file $name
     * @return int
     */
    public function atualizar(array $noticia, $arquivo='')
    {
        $pdo = $this->pdo->prepare('UPDATE noticias SET 
                                    id_categoria = :id_categoria,
                                    titulo = :titulo,
                                    subtitulo = :subtitulo,
                                    foto = :foto,
                                    video = :video,
                                    conteudo = :conteudo,
                                    WHERE id_noticia = :id_noticia                                    
                                 ');

        // tratar os dados recebidos    
        $titulo = trim($noticia['titulo']);
        $autor  = trim($noticia['subtitulo']);
       
        // fazer o upload da foto, caso tenha sido enviada
        if($arquivo)
        {
            $nome_foto = Helper::sobeArquivo($arquivo,'../imagens/');
            //verificar se o arqquivo foi movido parea a pasta imagens
            if($nome_foto)
            {
                $foto = $nome_foto;
            }
            else
            {
                $foto   = $noticia['foto_atual'];
            }
        }
        else
        {
            $foto   = $noticia['foto_atual'];

        }

        // mesclar os dados
        $pdo->bindParam(':id_noticia', $noticia['id_noticia']);

        $pdo->bindParam(':titulo', $titulo);
        $pdo->bindParam(':subtitulo', $subtitulo);
        $pdo->bindParam(':foto', $foto);
        $pdo->bindParam(':id_categoria',$noticia['id_categoria']);
        $pdo->bindParam(':video', $noticia['video']);
        $pdo->bindParam(':conteudo', $noticia['conteudo']);
        $pdo->execute();

        return $noticia['id_noticia']; 
    } 

/**
     * atualiza uma determinada noticia
     *
     * @param array $dados
     * @param file $foto
     * @return int id - da notica
     */
    public function editar(array $dados, $foto = null)
    {
            $sql = $this->pdo->prepare("UPDATE noticias SET
                                        id_usuario = :id_usuario,
                                        id_categoria = :id_categoria,
                                        titulo = :titulo,
                                        subtitulo = :subtitulo,
                                        foto = :foto,
                                        conteudo = :conteudo,
                                        video = :video
                                        WHERE id_noticia = :id_noticia
                                                        ");
                                                        // tratar dados
        $id_categoria   = $dados['id_categoria'];
        $id_noticia   = $dados['id_noticia'];

        $id_usuario     = $dados['id_usuario'];
        $conteudo       = $dados['conteudo'];
        $titulo         = ucfirst(strtolower(trim($dados['titulo']))) ;
        $subtitulo      = ucfirst(strtolower(trim($dados['subtitulo'])));
        $video          = trim($dados['video']);


// verificar se uma imagem foi enviada
        // se for enviadar, realizar o UPLOAD
        if($foto)
        {
            // verificar se alguma foto foi enviada 
            // e realizar o upload da imagem
            // verificar sew o upload deu certo
            if($foto){
                $nome_da_foto = Helper::sobeArquivo($foto,'../imagens/noticias/');
                //verificar se o upload deu certo
                if($nome_da_foto){
                    $foto = $nome_da_foto;
                }
                else
                {
                    // manter a foto que já existia na notícia
                    $foto = $dados['foto_atual'];
                }
            }
        }
        else
        {
            // manter a foto que já existia na notícia
            $foto = $dados['foto_atual'];

        }

        // mesclar os dados
        $sql->bindParam(':id_usuario', $id_usuario);
        $sql->bindParam(':id_categoria', $id_categoria);
        $sql->bindParam(':titulo', $titulo);
        $sql->bindParam(':subtitulo', $subtitulo);
        $sql->bindParam(':conteudo', $conteudo);
        $sql->bindParam(':foto', $foto);
        $sql->bindParam(':video', $video);
        $sql->bindParam(':id_noticia', $id_noticia);

        // executar o sql
        $sql->execute();
        return $id_noticia;
        }
            /**
     * Exclui um determinado noticia
     *
     * @param integer $id_noticia
     * @return void
     */
    public function excluir(int $id_noticia)
    {
        $sql = $this->pdo->prepare('DELETE FROM noticias 
                                    WHERE id_noticia = :id_noticia');
        $sql->bindParam(':id_noticia',$id_noticia);
        $sql->execute();
    }
}

?>