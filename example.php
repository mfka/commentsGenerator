<?php

function __autoload($className)
{
    require_once(__DIR__ . '/api/' . $className . '.php');
}

Manage::updateComment('article');