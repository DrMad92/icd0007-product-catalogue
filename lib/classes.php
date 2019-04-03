<?php

class Category{
    private $subcategoryList = array();
    private $name;
    private $titleID;
    private $id;

    public function __construct($name, $titleID, $id)
    {
        $this -> name = $name;
        $this -> titleID = $titleID;
        $this -> id = $id;
    }

    public function getAttributes(){
        return ["name" => $this -> name, "titleID" => $this -> titleID, "id" => $this -> id];
    }

    public function  getSubdirectory(){
        return $this -> subcategoryList;
    }

    public function fetchSubdirectory(){
        // update subdirectory array from db
    }

    public function updateSubdirectory($name, $remove = FALSE){
        if (!$remove){
            // add subdirectory to db
            fetchSubdirectory();
        }
        if ($remove) {
            // remove subdirectiory from db
            fetchSubdirectory();
        }
    }
}


?>