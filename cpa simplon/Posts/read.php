<?php
// Headers requis
// Accès depuis n'importe quel site ou appareil (*)
header("Access-Control-Allow-Origin: *");

// Format des données envoyées
header("Content-Type: application/json; charset=UTF-8");

// Méthode autorisée
header("Access-Control-Allow-Methods: GET");

// Durée de vie de la requête
header("Access-Control-Max-Age: 3600");

// Entêtes autorisées
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    // La bonne méthode est utilisée

}else{
    // Mauvaise méthode, on gère l'erreur
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}

// On inclut les fichiers de configuration et d'accès aux données
include_once '../config/Database.php';
include_once '../models/Posts.php';

// On instancie la base de données
$database = new Database();
$db = $database->getConnection();

// On instancie les posts
$produit = new Posts($db);

// On récupère les données
$stmt = $produit->lire();

// On vérifie si on a au moins 1 post
if($stmt->rowCount() > 0){
    // On initialise un tableau associatif
    $tableauProduits = [];
    $tableauPosts['posts'] = [];

    // On parcourt les posts
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $posts = [
            "Id" => $id,
            "Content" => $id,
            "Author" => $author,
            "Date" => $date,

        ];

        $tableauPosts['Posts'][] = $posts;
    }
    // On envoie le code réponse 200 OK
    http_response_code(200);

    // On encode en json et on envoie
    echo json_encode($tableauPosts);
}
// On récupère les données reçues
$donnees = json_decode(file_get_contents("php://input"));

// On vérifie qu'on a bien un id
if(!empty($donnees->id)){

}
// On récupère le produit
$produit->lireUn();

// On vérifie si le post existe
if($posts->id != null){
    // On crée un tableau contenant le produit
    $posts = [
        "Id" => $posts->id,
        "Content" => $posts->content,
        "Author" => $posts->author,
        "Date" => $posts->date,

    ];
    // On envoie le code réponse 200 OK
    http_response_code(200);

    // On encode en json et on envoie
    echo json_encode($prod);
}else{
    // 404 Not found
    http_response_code(404);
    
    echo json_encode(array("message" => "Le post n'existe pas."));
}
