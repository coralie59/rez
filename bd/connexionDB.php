<?php
/**déclaration de connection
 * 
 */
class connexionDB
{
	private $host = "127.0.0.1";
	private $name = "site";
	private $user = "root" ;
	private $pass = "";
	private $connexion;


	function __construct($host = null, $name = null, $user = null, $pass = null)
	{
		if ($host != null) {
			$this->host = $host;
			$this->name = $name;
			$this->user = $user;
			$this->pass = $pass;
		}
		try{
			$this->connexion = new PDO('mysql:host='.$this->host . ';dbname='.$this->name, $this->user, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAME UTF8', PDO::ATTR_ERRMODE=> PDO::ERRMODE_WARNING));
		}catch (PDOException $e){
			echo 'Erreur : impossible de se connecter à la BDD :-) !';
			die();
		}
	}

	public function query($sql, $data = array())
	{
		$req = $this->connexion->prepare($sql);
		$req->execute($data);
		return $req;
	}

	public function insert($sql, $data = array())
	{
		$req = $this->connexion->prepare($sql);
		$req->execute($data);
	}
}
$DB = new connexionDB();
?>