<?php

class Photo{
    public $photoName ;
    public $photoSize ;
    public $tempPath;
    public $type;

    public function __construct($file,$inputName){
        $this->photoName = $file[$inputName]['name'];
        $this->photoSize = $file[$inputName]['size'];
        $this->tempPath = $file[$inputName]['tmp_name'];
        $this->type = $file[$inputName]['type'];
    }

    public function isValidName(){
        if(strlen($this->photoName) > 100){
            return "Fotoğrafın ismi çok uzun.";
        }
    }

    public function isValidSize(){
        if ($this->photoSize > 2000000){
            return "Fotoğrafın boyutu çok fazla.";
        }
    }


}