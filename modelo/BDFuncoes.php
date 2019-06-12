<?php

include_once('BD.php');

  class BDFuncoes extends BD {


    public function getTodos( $tabela ) {
      $bd = parent::conectar();
      $busca = $bd->prepare("SELECT * FROM $tabela");
      $busca->execute();

      $linha = $busca->fetchAll(PDO::FETCH_ASSOC);

      return $linha;
    }

    public function getTodosCategoria( $tabela, $categoria ) {
      $bd = parent::conectar();
      $busca = $bd->prepare("SELECT * FROM $tabela WHERE categoria = '$categoria'");
      $busca->execute();

      $linha = $busca->fetchAll(PDO::FETCH_ASSOC);

      return $linha;
    }

    public function getQtdItem($idProduto) {
      $bd = parent::conectar();
      $busca = $bd->prepare("SELECT quantidade FROM item WHERE id = $idProduto");
      $busca->execute();

      $linha = $busca->fetchAll(PDO::FETCH_ASSOC);

      return $linha[0]['quantidade'];
    }

    public function confereUsuario($usuario, $senha) {
      
      $bd = parent::conectar();
      $busca = $bd->prepare("SELECT * FROM cadastro WHERE email = '$usuario' AND senha = '$senha'");
      $busca->execute();

      $linha = $busca->fetchAll(PDO::FETCH_ASSOC);

      

      if (isset($linha[0])){
        return true;
      } else {
        return false;
      }
    }

    public function inserirUsuario($nome, $sobrenome, $dataNascimento, $email, $senha, $endereço, $cidade, $cpf, $cep, $telefone, $sexo) {
      
      $bd = parent::conectar();

      $busca = $bd->prepare("SELECT * FROM cadastro WHERE email = '$email'");
      $busca->execute();

      $linha = $busca->fetchAll(PDO::FETCH_ASSOC);

      if (isset($linha[0])){
        return "Erro! E-mail já cadastrado.";
      }

      $query = $bd->prepare("INSERT INTO cadastro (nome, sobrenome, data_nascimento, sexo, email, senha, endereco, cidade, cpf, cep, telefone) VALUES ('$nome', '$sobrenome', '$dataNascimento', '$sexo', '$email', '$senha', '$endereço', '$cidade', '$cpf', '$cep', '$telefone');");
      $query->execute();

      return "Usuário cadastrado";
    } 

    public function inserirItemCarrinho($idProduto, $usuario, $qtd) {
      
      $bd = parent::conectar();

      $busca = $bd->prepare("SELECT * FROM carrinho WHERE id_cadastro = (SELECT id FROM cadastro WHERE email = '$usuario') AND id_item = $idProduto");
      $busca->execute();

      $linha = $busca->fetchAll(PDO::FETCH_ASSOC);

      if (isset($linha[0])){
        return "Erro! Produto já adicionado.";
      }

      $query = $bd->prepare("INSERT INTO carrinho (id_cadastro, id_item, qtd) VALUES ((SELECT id FROM cadastro WHERE email = '$usuario'), $idProduto, $qtd);");

      $query->execute();

      return "Produto adicionado ao carrinho";
    } 

    public function DeletarItemCarrinho($idProduto, $usuario) {
      
      $bd = parent::conectar();

      $query = $bd->prepare("DELETE FROM carrinho WHERE id_cadastro = (SELECT id FROM cadastro WHERE email = '$usuario') AND id_item = $idProduto;");

      $query->execute();

    }

    public function getItensCarrinho( $usuario ) {
      $bd = parent::conectar();
      $busca = $bd->prepare("SELECT * FROM carrinho, item WHERE carrinho.id_cadastro = (SELECT id FROM cadastro WHERE email = '$usuario') AND item.id = carrinho.id_item");
      $busca->execute();

      $linha = $busca->fetchAll(PDO::FETCH_ASSOC);

      return $linha;
    }

    public function limparCarrinho( $usuario ) {
      $bd = parent::conectar();
      
      $query = $bd->prepare("DELETE FROM carrinho WHERE id_cadastro = (SELECT id FROM cadastro WHERE email = '$usuario');");

      $query->execute();
    }

    public function subtrairItem( $id_item, $qtd) {
      $bd = parent::conectar();

      $qtdInicial = $this->getQtdItem($id_item);

      $qtdFinal = $qtdInicial - $qtd;
      
      $query = $bd->prepare("UPDATE item SET quantidade = $qtdFinal WHERE id = $id_item;");

      $query->execute();
    }

    public function comprarItensUsuario( $usuario ) {
      $itens = $this->getItensCarrinho($usuario);

      $bd = parent::conectar();

      foreach ($itens as $item) {
        $query = $bd->prepare("INSERT INTO compra (id_cadastro, id_item, qtd) VALUES ({$item['id_cadastro']}, {$item['id_item']}, {$item['qtd']});");

        $query->execute();

        $this->subtrairItem($item['id_item'], $item['qtd']);

      }

      $this->limparCarrinho($usuario);
    }
  }