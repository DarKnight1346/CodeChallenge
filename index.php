<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    $GLOBALS["config"] = array(
        "appName" => "ATT Sample App",
        "version" => "0.0.1",
        "domain" => "localhost",
        "cache_enabled" => false,
        "path" => array(
            "app" => "app/",
            "cache" => "caches/",
            "core" => "core/",
            "session" => "app/sessions", //no trailing forwardslash for session
            "index" => "index.php"
        ),
        "defaults" => array(
            "controller" => "main",
            "method" => "index"
        ),
        "routes" => array(),
        "database" => array(
            "name" => "database"
        )
    );
    date_default_timezone_set("America/Chicago");
    $GLOBALS["instances"] = array();
    require_once $GLOBALS["config"]["path"]["core"]."autoload.php";
    new router();
?>