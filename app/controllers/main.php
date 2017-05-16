<?php
class main extends controller{

    function index(){
        $appointments = new appointments();
        if(isset($_REQUEST["date"], $_REQUEST["desc"])){
            $appointments->create($_REQUEST["desc"], date("Y-m-d H:i:s", strtotime($_REQUEST["date"])));
        }
        load::view("main/index");
    }

    function getAppointments(){
        $appointments = new appointments();
        if($_REQUEST["searchTerm"]){
            $data["appointments"] = $appointments->search($_REQUEST["searchTerm"]);
        }else{
            $data["appointments"] = $appointments->getAll();
        }
        header('Content-Type: application/json');
        echo json_encode($data);
    }

}