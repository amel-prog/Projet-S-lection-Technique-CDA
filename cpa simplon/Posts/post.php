<?php
// Headers requis
// Accès depuis n'importe quel site ou appareil (*)
header("Access-Control-Allow-Origin: *");

// Format des données envoyées
header("Content-Type: application/json; charset=UTF-8");

// Méthode autorisée
header("Access-Control-Allow-Methods: POST");

// Durée de vie de la requête
header("Access-Control-Max-Age: 3600");

// Entêtes autorisées
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // La bonne méthode est utilisée

}else{
    // Mauvaise méthode, on gère l'erreur
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}
// On inclue les fichiers de configuration et d'accès aux données
include_once '../config/Database.php';
include_once '../models/Posts.php';

// On instancie la base de données
$database = new Database();
$db = $database->getConnection();

// On instancie les posts
$posts = new Posts($db);

// On récupère les données reçues
$donnees = json_decode(file_get_contents("php://input"));

// On vérifie qu'on a bien toutes les données
if(!empty($donnees->id) && !empty($donnees->content) && !empty($donnees->author) && !empty($donnees->date)){

}
// On instancie notre objet
$posts->Id = $donnees->Id;
$posts->Content = $donnees->content;
$posts->Author = $donnees->author;
$posts->Date = $donnees->date;

if($posts->create()){
    // Ici la création a fonctionné
    // On envoie un code 201
    http_response_code(201);
    echo json_encode(["message" => "Votre post  a été créé"]);
}else{
    // Ici la création n'a pas fonctionné
    // On envoie un code 503
    http_response_code(503);
    echo json_encode(["message" => "Votre Post n'existe pas"]);         
}
