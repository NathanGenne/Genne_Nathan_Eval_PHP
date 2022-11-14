<?php

// Paramètres de connexion à la base de données (à adapter en fonction de votre environnement);

define('HOST', 'localhost');
define('USER', 'root');
define('DBNAME', 'links_manager_dev');
define('PASSWORD', ''); // windows (Mamp le mot de passe c'est 'root')

/**
 * Fonction de connexion à la base de données
 *
 * @return \PDO
 */
function db_connect(): PDO
{
    try {
        /**
         * Data Source Name : chaine de connexion à la base de données
         * Elle permet de renseigner le domaine du serveur de la base de données, le nom de la base de données cible et l'encodage de données pendant leur transport
         * @var string
         */
        $dsn =  'mysql:host=' . HOST . ';dbname=' . DBNAME . ';charset=utf8';

        return new PDO($dsn, USER, PASSWORD, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    } catch (\PDOException $ex) {
        echo sprintf('La demande de connexion à la base de donnée a échouée avec le message %s', $ex->getMessage());
        exit(0);
    }
}


/**
 * Fonction qui permet de récupérer le tableau des enregistrements de la table des liens
 * @return array
 */
function get_all_link()
{
    $db = db_connect();

    $sql = <<<EOD
    SELECT *
    FROM `links`
    ORDER BY `link_id`
    EOD;
    $linksStmt = $db->query($sql);
    $links = $linksStmt->fetchAll(PDO::FETCH_ASSOC);
    return $links;
}


/**
 * Fonction qui permet de récupérer un enregistrement à partir de son identifiant dans la table des liens
 * @param integer $link_id
 * @return array
 */
function get_link_by_id($link_id)
{
    $db = db_connect();

    $sql = <<<EOD
    SELECT *
    FROM `links`
    WHERE link_id = :input_id
    EOD;

    $linkStmt = $db->prepare($sql);
    $linkStmt->bindValue(':input_id', $link_id);

    $linkStmt->execute();

    return $linkStmt->fetch();
}


/**
 * Fonction qui permet de modifier un enregistrement dans la table des liens
 * @param array $data: ['link_id' => 1, 'title' => 'MDN', 'url' => 'https://developer.mozilla.org/fr/']
 * @return bool
 */
function update_link($data)
{
    $db = db_connect();

    $sql = <<<EOD
    UPDATE `links` 
    SET `title` = :input_title,
        `url`   = :input_url
    WHERE `link_id` = :input_id
    EOD;
    
    $update_link = $db->prepare($sql);

    $update_link->bindValue(':input_id', $data['0']);
    $update_link->bindValue(':input_title', $data['1']);
    $update_link->bindValue(':input_url', $data['2']);

    $update_link->execute();
}


/**
 * Fonction qui permet de d'enregistrer un nouveau lien dans la table des liens
 * @param array $data: ['title' => 'MDN', 'url' => 'https://developer.mozilla.org/fr/']
 * @return bool
 */
function create_link($data)
{
    $db = db_connect();

    $sql = <<<EOD
    INSERT INTO `links` (`title`, `url`)
    VALUES (:input_title, :input_url)
    EOD;
    
    $add_link = $db->prepare($sql);

    $add_link->bindValue(':input_title', $data[0]);
    $add_link->bindValue(':input_url', $data[1]);

    $add_link->execute();
}

/**
 * Fonction qui permet de supprimer l'enregistrement dont l'identifiant est $linl_id dans la table des liens
 *@param integer $link_id
 * @return bool
 */
function delete_link($link_id)
{
    $db = db_connect();

    $sql = <<<EOD
    DELETE FROM links
    WHERE link_id = :input_id
    EOD;
    
    $delete_link = $db->prepare($sql);

    $delete_link->bindValue(':input_id', $link_id);

    $delete_link->execute();
}