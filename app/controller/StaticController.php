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
        $this->view->action = "Sobre";
    }
    
    public function contactAction() {
        $this->view->action = "Contato";
        if ($this->request->isPost() == true) {
            // TODO: save message and/or send a email and/or sms
        }
    }

}
