<?php

require_once(PATH_CONFIG . "conf_db.php");

abstract class DataObject {

    protected $data = array();

    public function __construct($data) {
        foreach ($data as $key => $value) {
            if (array_key_exists($key, $this->data)) $this->data[$key] = $value;
        }
    }

    public function getValue($field) {
        //indice
        if (array_key_exists($field, $this->data)) {
            return $this->data[$field];
        } else {
            die("Field not found $field");
        }
    }

    public function getValueEncoded($field) {
        return htmlspecialchars($this->getValue($field));
    }

    protected static function connect() {
        try {
            $connexion = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
        return $connexion;
    }

    protected static function disconnect(&$connexion) {
        $connexion = "";
    }
}

?>
