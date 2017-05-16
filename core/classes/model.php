<?php
    class model{
        public $model;
        function __construct() {
            $this->model = new database($GLOBALS["config"]["database"]["name"]);
        }
    }
?>