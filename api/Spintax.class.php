<?php

class Spintax
{
    public function checkText($text)
    {
        return preg_match('/[{}]*/m', $text) == 1 ? TRUE : FALSE;
    }

    public function choose($text)
    {
        if ($this->checkText($text)) {
            return preg_replace_callback(
                '/\{(((?>[^\{\}]+)|(?R))*)\}/x',
                array($this, 'replace'),
                $text
            );
        } else {
            error_log("Error text in file doesn't contain text between {}");
        }

    }

    public function replace($text)
    {
        $text = $this->choose($text[1]);
        $parts = explode('|', $text);
        return $parts[array_rand($parts)];
    }
}