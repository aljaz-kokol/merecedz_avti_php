<?php
session_start();
define('ROOT', __DIR__.DIRECTORY_SEPARATOR);
define('APP', ROOT.'app'.DIRECTORY_SEPARATOR);
define('_PUBLIC', ROOT.'public'.DIRECTORY_SEPARATOR);
define('CONTROLLER', APP.'controller'.DIRECTORY_SEPARATOR);
define('CORE', APP.'core'.DIRECTORY_SEPARATOR);
define('DATA', APP.'data'.DIRECTORY_SEPARATOR);
define('MODEL', APP.'model'.DIRECTORY_SEPARATOR);
define('ROUTES', APP.'routes'.DIRECTORY_SEPARATOR);
define('VIEW', APP.'view'.DIRECTORY_SEPARATOR);

$modules = [ROOT, APP, CORE, CONTROLLER, DATA, MODEL];
set_include_path(get_include_path().PATH_SEPARATOR.implode(PATH_SEPARATOR, $modules));
spl_autoload_register('spl_autoload', false);

require_once(ROUTES.'web.php');