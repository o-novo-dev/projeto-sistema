<?php
$ssl_set = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == "on")) ? "s" : "";
$pasta = "/projeto-sistema";
$url = 'http'. $ssl_set.'://'.$_SERVER ['HTTP_HOST'].$pasta;

//config site
define("DIR_ROOT", $_SERVER['DOCUMENT_ROOT']);
define("DIR_PUBLIC", $_SERVER['DOCUMENT_ROOT'] . $pasta . "/public");
define("BASE_URL", $url);
define("ASSETS_URL", "{$url}/public");

$subdominio = explode('.', $_SERVER['HTTP_HOST'])[0];

if ($subdominio == 'localhost') $subdominio = 'staartdev';

define("SUBDOMINIO", $subdominio);