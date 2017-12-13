<?php

require_once __DIR__ . "/../bootstrap.php";

$parameters = array(
    "projectname" => "Bare Project",
    "company"     => "Akademi Hukuk"
);

echo $twig->render("index.html", $parameters);

?>