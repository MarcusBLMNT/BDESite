<?php
//script faisant un lien avec la bdd -> évite la redondance de code
//fontion pour instancier un objet bdd connecté à notre base de données. l'addresse bdd est accessible via le fichier adresseBDD.json
function bddConnect()
{
    $adressebdd = file_get_contents('../public/api/AdresseBDD/adresseBDD.json');
    $adresseBDDJsonParsed = json_decode($adressebdd);
    $bdd = new PDO('mysql:host=' . $adresseBDDJsonParsed->{"host"} . ';port=' .
        $adresseBDDJsonParsed->{"port"} . ';dbname=' . $adresseBDDJsonParsed->{"dbname"} .
        ';', $adresseBDDJsonParsed->{"pseudo"}, $adresseBDDJsonParsed->{"mdp"});
    return $bdd;
}

class DB
{

    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'bddprojetweb';
    private $db;






    public function __construct($host = null, $username = null, $password = null, $database = null)
    {
        if ($host != null) {
            $this->host = $host;
            $this->username = $username;
            $this->password = $password;
            $this->username = $username;
            $this->database = $database;
        }
        try {
            $this->db = bddConnect();
        } catch (PDOException $e) {
            die('Impossible de se connnecter à la BDD');
        }
    }
    public function query($sql)
    {
        $req = $this->db->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_OBJ);
    }
}
