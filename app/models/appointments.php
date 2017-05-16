<?php
class appointments extends model{

    function create($description, $date){
        $this->model->query("INSERT INTO `appointments`(`date`,`description`) VALUES(:date,:desc)", array("date" => $date, "desc" => $description));
    }

    function getAll(){
        $this->model->query("SELECT * FROM `appointments`");
        return $this->model->fetch_all_kv();
    }

    function search($searchTerm){
        $searchTerm = "%{$searchTerm}%";
        $this->model->query("SELECT * FROM `appointments` WHERE `date` LIKE :term OR `description` LIKE :term", array("term" => $searchTerm));
        return $this->model->fetch_all_kv();
    }

}