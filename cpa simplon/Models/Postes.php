<?php
class Posts{
    // Connexion
    private $connexion;
    private $table = "Posts"; // Table dans la base de données

    // Propriétés

    public $id;
    public $content;
    public $author;
    public $date;


    /**
     * Constructeur avec $db pour la connexion à la base de données
     *
     * @param $db
     */
    public function __construct($db){
        $this->connexion = $db;
    }
}
/**
 * Créer un post
 *
 * @return void
 */
public function create(){

    // Ecriture de la requête SQL en y insérant le nom de la table
    $sql = "INSERT INTO " . $this->table . " SET Id=:Id, Content=:Content, Author=:Author, Topic_id=:Topic_id, date=:date";

    // Préparation de la requête
    $query = $this->connexion->prepare($sql);

    // Protection contre les injections
    $this->Id=htmlspecialchars(strip_tags($this->Id));
    $this->Content=htmlspecialchars(strip_tags($this->Content));
    $this->Author=htmlspecialchars(strip_tags($this->Author));
    $this->Topic_id=htmlspecialchars(strip_tags($this->Topic_id));
    $this->date=htmlspecialchars(strip_tags($this->date));

    // Ajout des données protégées
    $query->bindParam(":Id", $this->Id);
    $query->bindParam(":Content", $this->Content);
    $query->bindParam(":Author", $this->Author);
    $query->bindParam(":Topic_id", $this->Topic_id);
    $query->bindParam(":date", $this->date);

    // Exécution de la requête
    if($query->execute()){
        return true;
    }
    return false;
}
/**
 * Lecture des Posts
 *
 * @return void
 */
public function read_all(){
    // On écrit la requête
    $sql = "SELECT Post.Id as  Post.id, Post.content, Post.Author,Post.date FROM " . $this->table . " p LEFT JOIN categories c ON Post_id = c.id ORDER BY p.created_at DESC";

    // On prépare la requête
    $query = $this->connexion->prepare($sql);

    // On exécute la requête
    $query->execute();

    // On retourne le résultat
    return $query;
}
/**
 * Lire un post
 *
 * @return void
 */
public function readOne(){
    // On écrit la requête
    $sql = "SELECT Post.Id as Post.id, Post.content, Post.Author,Post.date  FROM " . $this->table . " p LEFT JOIN categories c ON p.categories_id = c.id WHERE p.id = ? LIMIT 0,1";

    // On prépare la requête
    $query = $this->connexion->prepare( $sql );

    // On attache l'id
    $query->bindParam(1, $this->id);

    // On exécute la requête
    $query->execute();

    // on récupère la ligne
    $row = $query->fetch(PDO::FETCH_ASSOC);

    // On nomme l'objet
    $this->Id = $row['Id'];
    $this->Content = $row['Content'];
    $this->Author = $row['Author'];
    $this->Date = $row['Date'];

}
/**
 * Mettre à jour un post
 *
 * @return void
 */
public function update(){
    // On écrit la requête
    $sql = "UPDATE " . $this->table . " SET nom = :nom, prix = :prix, description = :description, categories_id = :categories_id WHERE id = :id";
    
    // On prépare la requête
    $query = $this->connexion->prepare($sql);
    
    // On sécurise les données
    $this->nom=htmlspecialchars(strip_tags($this->nom));
    $this->prix=htmlspecialchars(strip_tags($this->prix));
    $this->description=htmlspecialchars(strip_tags($this->description));
    $this->categories_id=htmlspecialchars(strip_tags($this->categories_id));
    $this->id=htmlspecialchars(strip_tags($this->id));
    
    // On attache les variables
    $query->bindParam(':nom', $this->nom);
    $query->bindParam(':prix', $this->prix);
    $query->bindParam(':description', $this->description);
    $query->bindParam(':categories_id', $this->categories_id);
    $query->bindParam(':id', $this->id);
    
    // On exécute
    if($query->execute()){
        return true;
    }
    
    return false;
}
/**
 * Supprimer un post
 *
 * @return void
 */
public function delete(){
    // On écrit la requête
    $sql = "DELETE FROM " . $this->table . " WHERE id = ?";

    // On prépare la requête
    $query = $this->connexion->prepare( $sql );

    // On sécurise les données
    $this->id=htmlspecialchars(strip_tags($this->id));

    // On attache l'id
    $query->bindParam(1, $this->id);

    // On exécute la requête
    if($query->execute()){
        return true;
    }
    
    return false;
}