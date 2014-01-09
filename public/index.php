<?

// Start some constants
define("ROOT_DIR", realpath(__DIR__ . '/../') . '/');
define("APP_DIR", realpath(__DIR__ . '/../app') . '/');
define("CONTROLLER_DIR", APP_DIR . 'controller/');
define("SERVICE_DIR", APP_DIR . 'service/');
define("LIB_DIR", APP_DIR . 'lib/');


try {
    // Register an autoloader
    $loader = new \Phalcon\Loader();
    $loader->registerDirs(array(
        '../app/controller/',
        '../app/models/'
    ))->register();
    // Create a DI
    $di = new Phalcon\DI\FactoryDefault();



    //Setup a base URI so that all generated URIs include the "fornalha" folder
    $di->set('url', function() {
        $url = new \Phalcon\Mvc\Url();
        $url->setBaseUri('/fornalha/');
        return $url;
    });


    //Registering the view component
    $di->set('view', function() {

        $view = new \Phalcon\Mvc\View();
        $view->setViewsDir('../app/view/');

        $viewEngineFunction = function($view, $di) {
            $volt = new \Phalcon\Mvc\View\Engine\Volt($view, $di);

            $volt->setOptions(array(
                "compiledPath" => "/tmp/compiled-templates",
                "compiledExtension" => ".compiled",
                'compileAlways' => true
            ));

            return $volt;
        };

        $view->registerEngines(array(
            ".volt" => $viewEngineFunction,
            '.phtml' => $viewEngineFunction
        ));

        return $view;
    });
    
    //Register the flash service with custom CSS classes
    $di->set('flashSession', function() {
        $flash = new \Phalcon\Flash\Session(array(
            'error' => 'alert alert-error',
            'success' => 'alert alert-success',
            'notice' => 'alert alert-info',
            'warning' => 'alert alert-warning'
        ));
        return $flash;
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
                    return false;
            }
        });
        $dispatcher = new \Phalcon\Mvc\Dispatcher();
        $dispatcher->setEventsManager($evManager);
        return $dispatcher;
    }, true);

    //Handle the request
    $application = new \Phalcon\Mvc\Application($di);

    echo $application->handle()->getContent();
} catch (\Phalcon\Exception $e) {
    echo "PhalconException: ", $e->getMessage();
    echo $e->getTraceAsString();
}