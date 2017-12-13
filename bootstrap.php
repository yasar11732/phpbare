<?php
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Dotenv\Dotenv;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

const root = __DIR__ . "/./";

require_once root . "vendor/autoload.php";

/* Create Dotenv */
$dotenv = new Dotenv(root);
$dotenv->load();

/* Create Doctrine ORM */
$doctrine_config = Setup::createAnnotationMetadataConfiguration(array(root . "entities"), $_SERVER["DEVEL"]);
$doctrine_conn = array(
    "dbname"   => $_SERVER["DBNAME"],
    "user"     => $_SERVER["DBUSER"],
    "password" => $_SERVER["DBPASSWORD"],
    "host"     => $_SERVER["DBHOST"],
    "port"     => $_SERVER["DBPORT"],
    "driver"   => "pdo_mysql"
);

$doctrine = EntityManager::create($doctrine_conn, $doctrine_config);

/* Create Logger */
$handler = new StreamHandler('app.log', Logger::WARNING);
$log = new Logger('name');
$log->pushHandler($handler);

/* Create Template Loader */
$loader = new Twig_Loader_Filesystem(root . "templates");
$twig   = new Twig_Environment($loader, array('cache', root . "cache"));
?>