<?php

function __autoload($className)
{
    require_once(__DIR__ . '/api/' . $className . '.class.php');
}

class randomComment
{
    public static function updateComment($object_type)
    {
        $types = array('motivation', 'article', 'meal', 'product');
        if (in_array($object_type, $types)) {
            $id = ($object_type == 'motivation' ? 'id_motywacja' : 'id');
            $object = dbAction::noComments($object_type);
            if (!$object) {
                $object = dbAction::selectObject($object_type);
            }
            if ($object) {
                $author = new Author();
                $author->chooseAuthor();
                $comObj = new Comment($object_type);
                $comment = $comObj->chooseComment();
                while (dbAction::commentExists($comment)) {
                    $comment = $comObj->chooseComment();
                }
                if ($comment != '') {
                    echo trim($comment) . "\n";
                    echo trim($author) . "\n";
                    //                    dbAction::saveComment($author, $comment, $object[$id], $object_type);
                }
            }
        } else {
            error_log("Error worng object type! " . $object_type . " doesn't exist\n");
        }
    }
}


//randomComment::updateComment('motivation');
//randomComment::updateComment('article');
//randomComment::updateComment('meal');
randomComment::updateComment('product');
