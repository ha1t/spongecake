<?php
define('ROOT_DIR', dirname(dirname(__DIR__)).'/');
define('APP_DIR', ROOT_DIR.'/app/');
// PHP5.4 built-in web server support
if (php_sapi_name() === 'cli-server') {
    $cli_filepath = preg_replace('/(\?.*)\z/', '', $_SERVER['REQUEST_URI']);
    if (is_file(__DIR__.$cli_filepath)) {
        return false;
    }
    $_REQUEST['dc_action'] = preg_replace('/\A\//', '', $cli_filepath);
} else {
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $path = preg_replace('|^' . dirname($_SERVER['SCRIPT_NAME']) . '|', '', $path); // ルートディレクトリ以外に置かれた場合
    if ($path === null) {
        throw new ErrorException('REQUEST_URIの抽出に失敗しました');
    }
    if ($path == '/') {
        $_REQUEST['dc_action'] = 'default/index';
    } else {
        $_REQUEST['dc_action'] = trim($path, '/');
    }
}
require_once ROOT_DIR.'vendor/dietcake/dietcake/dietcake.php';
require_once CONFIG_DIR.'bootstrap.php';
require_once CONFIG_DIR.'core.php';

$action = explode('/', Param::get(DC_ACTION));

if (count($action) < 2) {
    throw new DCException('invalid url format');
}

$action_name = $action[1];
$controller_name = $action[0];

$controller = Dispatcher::getController($controller_name);

$controller->action = $action_name;
$controller->beforeFilter();
$controller->dispatchAction();
$controller->afterFilter();

echo $controller->output;
