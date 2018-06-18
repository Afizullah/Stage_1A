<?php

    try {
            $db = new PDO('mysql:host=localhost; dbname=livret; charset=utf8', 'livret', 'livret1234');
        }
    catch (Exception $e) {
            die('Erreur : ' . $e -> getMessage());
    }

?>
