<?

require_once '../etc/config.php';
require_once SERVICE_DIR . 'Config.php';

$app_config = Config::getInstance();
// set default timezone
date_default_timezone_set('America/Sao_Paulo');

try {
    // Register an autoloader
    $loader = new \Phalcon\Loader();
    $loader->registerDirs(array(
        '../app/controller/',
        '../app/models/',
        '../app/plugin/'
    ))->register();
    // Create a DI
    $di = new Phalcon\DI\FactoryDefault();


    //Setup a base URI so that all generated URIs include the "fornalha" folder
    $di->set('url', function() {
        $url = new \Phalcon\Mvc\Url();
        $config = Config::getInstance();
        if ($config['env']['path'] != '') {
            $url->setBaseUri($config['env']['path']);
        }
        return $url;
    });

    //Registering the view component
    $di->set('view', function() {

        $view = new \Phalcon\Mvc\View();
        $view->setViewsDir('../app/view/');

        $viewEngineFunction = function($view, $di) {
            $volt = new \Phalcon\Mvc\View\Engine\Volt($view, $di);

            $config = Config::getInstance();
            if ($config->isProduction()) {
                $volt->setOptions(array(
                    "compiledExtension" => ".compiled",
                ));
            } else {
                $volt->setOptions(array(
                    "compiledPath" => "/tmp/compiled-templates",
                    "compiledExtension" => ".compiled",
                    'compileAlways' => true
                ));
            }

            $compiler = $volt->getCompiler();

            $compiler->addFunction('formatDate', 'formatDate');
            $compiler->addFunction('count', 'count');

            return $volt;
        };

        $view->registerEngines(array(
            ".volt" => $viewEngineFunction,
            '.phtml' => $viewEngineFunction
        ));

        return $view;
    });

    // Get class/action not found error    
    $di->set('dispatcher', function() use ($di) {
        $evManager = $di->getShared('eventsManager');
        $evManager->attach("dispatch:beforeException", function($event, $dispatcher, $exception) {
            switch ($exception->getCode()) {
                case \Phalcon\Mvc\Dispatcher::EXCEPTION_HANDLER_NOT_FOUND:
                case \Phalcon\Mvc\Dispatcher::EXCEPTION_ACTION_NOT_FOUND:
                    $dispatcher->forward(
                            array(
                                'controller' => 'error',
                                'action' => 'show404',
                            )
                    );
                    break;
                default :
                    $dispatcher->setParams(array('exception' => $exception));
                    $dispatcher->forward(array(
                        'controller' => 'error',
                        'action' => 'exception'));
                    break;
            }
            return false;
        });

        //Instantiate the Security plugin
        $security = new Security($di);

        //Listen for events produced in the dispatcher using the Security plugin
        $evManager->attach('dispatch', $security);

        $dispatcher = new \Phalcon\Mvc\Dispatcher();
        $dispatcher->setEventsManager($evManager);

        return $dispatcher;
    }, true);

    //Handle the request
    $application = new \Phalcon\Mvc\Application($di);

    echo $application->handle()->getContent();
} catch (\Exception $e) {
    if (!$app_config->isProduction()) {
        echo "Exception: ", $e->getMessage();
        echo '<pre>';
        echo $e->getTraceAsString();
        echo '</pre>';
    } else {
        header('Location: ' . $config['env']['path'] . '/error/exception');
    }
}