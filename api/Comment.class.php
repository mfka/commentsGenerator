<?php
require_once(__DIR__ . '/Spintax.class.php');

class Comment extends Spintax
{
    private $comments = '';
    public $comment = '';

    public function __construct($object_type)
    {
        switch ($object_type) {
            case ('motivation'):
                $comments = file_get_contents(__DIR__ . '/../texts/motivation.txt');
                break;
            case ('article'):
                $comments = file_get_contents(__DIR__ . '/../texts/article.txt');
                break;
            case ('product'):
                $comments = file_get_contents(__DIR__ . '/../texts/product.txt');
                break;
            case ('meal'):
                $comments = file_get_contents(__DIR__ . '/../texts/meal.txt');
                break;
            default:
                error_log('Wrong object_type');
                return false;
        }
        if (trim($comments) == false) {
            error_log("Error File with comments for " . $object_type . " is empty \n");
            return false;
        } else {
            return $this->comments = $comments;
        }
    }

    public function chooseComment()
    {

        return $this->comment = $this->choose($this->comments);
    }

    public function __toString()
    {
        return $this->comment;
    }

}