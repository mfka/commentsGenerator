<?php

class dbAction
{

    static private $db = '';
    static private $host = '';
    static private $port = '';
    static private $user = '';
    static private $pass = '';
    static public $conn = '';

    static private function getConnection()
    {
        try {
            $dbConn = new PDO ('mysql:host=' . self::$host . ';port=' . self::$port . ';dbname=' . self::$db, self::$user, self::$pass, [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'']);
            $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return self::$conn = $dbConn;
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
        }
    }


    static public function getNoCommentsRecord($object_type)
    {
        switch ($object_type) {
            case('product'):
                $table = 'product';
                break;
            case('article'):
                $table = 'article';
                break;
            case('meal'):
                $table = 'meal';
                break;
            case('motivation'):
                $table = 'motivation';
                break;
            default:
                error_log('Table with this name ' . $object_type . ' does not exist');
                break;
        }
        self::getConnection();
        try {
            $stmt = self::$conn->prepare('SELECT * FROM ' . $table . ' WHERE comments IN (0,NULL) ORDER BY RAND() LIMIT 1');
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        self::closeConnection();
    }

    static public function saveComment($nick, $text, $object_id, $object_type)
    {
        try {
            $stmt = self::$conn->prepare('INSERT IGNORE INTO comments(object_id, object_type, nick, text, spintax, approved) VALUES (:object_id, :object_type, :nick, :text, 1, 1)');
            $stmt->bindParam(':object_id', $object_id);
            $stmt->bindParam(':object_type', $object_type);
            $stmt->bindParam(':nick', $nick);
            $stmt->bindParam(':text', $text);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error " . $e->getMessage() . "\n");
        }
    }

    static public function commentExists($comment)
    {
        self::getConnection();
        try {
            $stmt = self::$conn->prepare('SELECT * FROM comments WHERE text ="' . $comment . '"');
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
        }
        self::closeConnection();
    }

    private function closeConnection()
    {
        $this->conn = null;
    }
}

