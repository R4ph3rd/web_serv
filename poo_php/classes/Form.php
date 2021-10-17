<?php

class Form {
    
    public $data;
    private $tag = 'div';

    public function __construct($data = []){
        $this->data = $data;
    }

    private function getVal ($name){
        return isset($this->data[$name]) ? $this->data[$name] : null;
    }

    private function surround($html){
        return "<{$this->tag}>{$html}</{$this->tag}>";
    }

    public function input($name, $type = 'text'){
        if (isset($type) && $type == 'submit'){
            $html = '<button type="submit">Envoyer</button>';
        } else {
            $html = '<label for="'.$name.'">'.$name.'</label>
            <input type="'.$type.'" name="'.$name.'" value="'.$this->getVal($name).'"/>' ;
        }

        return $this->surround($html);
    }
}