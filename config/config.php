<?php

/** Configuration Variables **/

define ('DEVELOPMENT_ENVIRONMENT',true);


define('DB_NAME', 'projet_plan-cadre');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');

// le dossier qui contient le projet (framework_test)
define('BASE_PATH','http://localhost/' . basename( dirname(__DIR__) ) );



define('PAGINATE_LIMIT', '5');