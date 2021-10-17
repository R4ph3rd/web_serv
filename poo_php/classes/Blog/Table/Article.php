<?php

namespace Blog\Table;


class Article{

    public $url;

    public function __get($key){
        $method = 'get'.ucfirst($key); // ucfirst = capitalize
        $this->$key = $this->$method(); // je crée la string de la fonction et je la stocke en variable 

        return $this->$method(); // je renvoie la méthode
    }

    public function getUrl(){
        return 'index.php?p=article&id='.$this->id;
    }

    public function getContent(){
        return '<p>'.substr($this->contenu, 0, 100).'...</p>
        </br>
        <a href="'.$this->url.'">Voir la suite</a>
        ';
    }
}