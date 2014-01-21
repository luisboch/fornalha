<?php
require_once 'OpenBase.php';


/**
 * Description of StaticController
 *
 * @author luis
 */
class StaticController extends OpenBase {

    public function indexAction() {
        $this->dispatcher->forward(array(
            'controller' => 'static',
            'action' => 'aboutus'
        ));
        return false;
    }

    public function aboutusAction() {
        $this->setTitle("Sobre Nós");
    }

}
