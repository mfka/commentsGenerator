<?php
require_once(__DIR__ . '/Spintax.class.php');

class Author extends Spintax
{
    private $authors = '';
    public $author = '';

    public function __construct()
    {
        $this->authors = (file_get_contents(__DIR__ . "/../texts/authors.txt"));
    }

    public function chooseAuthor()
    {
        return $this->author = trim($this->choose($this->authors));
    }

    public function __toString()
    {
        return $this->author;
    }
}