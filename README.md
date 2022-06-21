# Configurar

Add pasta config
Na pasta config add o arquivo ini.php

> add no arquivo ini.php

```php
<?php
$ssl_set = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "s" : "";
$pasta = "/projeto-sistema/";
$url = 'http'. $ssl_set.'://'.$_SERVER ['HTTP_HOST'].$pasta;

//config site
define("BASE_URL", $url);
define("ASSETS_URL", "{$url}/public");

//config database
define("DBNAME", "pet");
define("USERNAME", "root");
define("PASSWORD", "");
```