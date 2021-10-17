<?php

include('./classes/Blog/DB.php');

// define url
if (isset($_GET['p'])){
    $p = $_GET['p'];
} else {
    $p = 'home';
}

// instanciate objects
$blog = new Blog\db('blog');

switch($p){
    case ('home'):
        require('./PageTemplates/Home.php');
        break;
    case ('article'):
        require('./PageTemplates/Article.php');
        break;
    default:
        require('./PageTemplates/Home.php');
}