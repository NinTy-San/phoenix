<?php
// Fichier de configuration du site 

// connexion à la BDD :
    $pdo = new PDO('mysql:host=localhost;dbname=phoenix', 
                'root', 
                '',
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                      PDO::MYSQL_ATTR_INIT_COMMAND => 'set NAMES utf8')
);

require_once 'fonctions.inc.php';

