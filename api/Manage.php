<?php

class Manage
{
    private static $types = array('motivation', 'article', 'meal', 'product');

    public static function updateComment($object_type)
    {

        if (in_array($object_type, self::$types)) {
            $object = dbAction::getNoCommentsRecord($object_type);

            if ($object) {
                $objAuthor = new Author();
                $objAuthor->chooseAuthor();
                $objComment = new Comment();
                $comment = $objComment->chooseComment();
                while (dbAction::commentExists($comment)) {
                    $comment = $objComment->chooseComment();
                }

                if ($comment != '') {
                    dbAction::saveComment($objAuthor->author, $comment, $object['id'], $object_type);
                }
            }
        } else {
            error_log("Error worng object type! " . $object_type . " doesn't exist\n");
        }
    }

}