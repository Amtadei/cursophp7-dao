<?php

class Usuario {

	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function getIdusuario(){
		return $this->idusuario;
	}
	public function setIdusuario($pvalue){
		$this->idusuario = $pvalue;
	}
	public function getDeslogin(){
		return $this->deslogin;
	}
	public function setDeslogin($pvalue){
		$this->deslogin = $pvalue;
	}
	public function getDessenha(){
		return $this->dessenha;
	}
	public function setDessenha($pvalue){
		$this->dessenha = $pvalue;
	}
	public function getDtcadastro(){
		return $this->dtcadastro;
	}
	public function setDtcadastro($pvalue){
		$this->dtcadastro = $pvalue;
	}

	public function loadById($id){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID" , array(
			":ID"=>$id 
		));

		if (count($results) > 0) {

			$this->setData($results[0]);

		}

	}

	public static function getList(){

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");

	}

	public static function search($login){

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
			':SEARCH'=>"%".$login."%"
		));

	}

	public function login($login, $senha){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND  dessenha = :PASSWORD" , Array(":LOGIN"=>$login,
		       	  ":PASSWORD"=>$senha
		));

		if (count($results) > 0) {

			$this->setData($results[0]);

		} else {

			throw new Exception("Login e/ou senha inválidos.");
			
		}

	}

	public function setData($dados){

		$this->setIdusuario($dados['idusuario']);
		$this->setDeslogin($dados['deslogin']);
		$this->setDessenha($dados['dessenha']);
		$this->setDtcadastro(new DateTime($dados['dtcadastro']));

	}

	public function insert(){

		$sql = new Sql();

		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :SENHA)", array(
			':LOGIN'=>$this->getDeslogin(),
			':SENHA'=>$this->getDessenha()
		));

		if (count($results) > 0) {

			$this->setData($results[0]);

		} 

	}

	public function update($login, $senha){

		$this->setDeslogin($login);
		$this->setDessenha($senha);

		$sql = new Sql();

		$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN , dessenha = :SENHA WHERE idusuario = :ID", array(
			':LOGIN'=>$this->getDeslogin(),
			':SENHA'=>$this->getDessenha(),
			':ID'=>$this->getIdusuario()

		));

	}

	public function delete(){

		$sql = new Sql();

		$sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
			':ID'=>$this->getIdusuario()
		));

		$this->setIdusuario(0);
		$this->setDeslogin("");
		$this->setDessenha("");
		$this->setDtcadastro(new DateTime());

	}

	public function __construct($login = "", $senha = ""){

		$this->setDeslogin($login);
		$this->setDessenha($senha);

	}

	public function __toString(){

		return json_encode(array(
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
		));
	}

}

?>
