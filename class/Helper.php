<?php

/**
 * Classe com metodos estáticos
 */
class Helper{

  /**
   * Sobe Arquivo
   * @param  file  $arquivo    - Pode ser uma imagem ou qualquer outro
   *                             tipo de arquivo
   * @param  string $diretorio - Caminho da pasta onde o arquivo
   *                             será armazenado
   * @return string || false     - nome do arquivo
   */
public static function sobeArquivo($arquivo,$diretorio = 'imagens/'){
    $arquivo = $arquivo;
    // pegar apenas o nome original do arquivo
    $nome_arquivo = $arquivo['name'];
      // verificar se algum arquivo foi enviado
      if(trim($nome_arquivo)!= '') {
          // pegar a extensao do arquivo         
          $extensao = explode('.', $nome_arquivo);
          // gerar nome         
          $novo_nome = date('YmdHis').rand(0,1000).'.'.end($extensao);         

          // montar o destino onde o arquivo será armazenado         
          $destino = $diretorio.$novo_nome;                  
          $ok = move_uploaded_file($arquivo['tmp_name'],$destino);
          // verificar se o upload foi realizado
          if($ok) {
            return $novo_nome;            
          } else {
            return false;
          }

      } else {
        return false;
      }
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
     * retorna o nome do autor
     *
     * @param integer $id_usuario
     * @return string
     */

    public static function nomeDoAutor(int $id_usuario)
    {
        $pdo = Conexao::conexao();
        $sql = $pdo->prepare('SELECT * FROM usuarios 
                                    WHERE id_usuario = :id_usuario');
        $sql->bindParam(':id_usuario', $id_usuario);
        $sql->execute();
        $usuario = $sql->fetch(PDO::FETCH_OBJ);
        return $usuario->nome;
    }


}

?>