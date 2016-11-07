<?php
class Modele
{
private $monPdo;
private static $bdd=null; //instance unique de la classe
//
//Constructeur privé, crée l'instance de PDO qui sera sollicitée
//pour toutes les méthodes de la classe
//
private function __contruct()
{
    $this->monPdo = new PDO('mysql:host=localhost;dbname=monblog;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
}

public function __destruct() {
    $this->monPdo = null;
}
//effectue la connexion à la bdd
//instancie et renvoie l'objet PDO associé
public static function getBdd()
{
    if (self::$bdd==null) { 
        self::$bdd = new Modele();
     
    }
    return self::$bdd;
}

public function getBillets()
{
    $requeteBillets = "select * from T_BILLET order by BIL_ID desc";
    $stmtBillets = $this->monPdo->query($requeteBillets);
    $billets = $stmtBillets->fetchAll();
    return $billets;
}

public function getBillet($idBillet)
{
    $requeteBillet = "select * from T_BILLET where BIL_ID= $idBillet";
    $stmtBillet = $this->monPdo->query($requeteBillet);
    $billet = $stmtBillet->fetch();  // Accès au premier élément résultat
    return $billet;
}

}
