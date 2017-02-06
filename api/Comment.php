<?php
require_once(__DIR__ . '/Spintax.php');

class Comment extends Spintax
{
    private $comments = '';
    public $comment = '';

    public function __construct()
    {

        return $this->comments = file_get_contents(__DIR__ . '/../txt/comments.txt');
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