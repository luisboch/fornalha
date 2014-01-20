<?php

require_once 'OpenBase.php';
require_once SERVICE_DIR . 'NewsLetterService.php';
require_once SERVICE_DIR . 'MailService.php';

/**
 * Description of ContactController
 *
 * @author luis
 * 
 */
class ContactController extends OpenBase {

    /**
     *
     * @var NewsLetterService
     */
    private $service;

    public function initialize() {
        parent::initialize();
        $this->service = new NewsLetterService();
        $this->setTitle("Contato");
    }

    public function indexAction() {
        $this->view->instance = new NewsLetter();
        $this->view->message = '';
    }

    public function sendAction() {
        if ($this->request->isPost()) {

            $newsLetter = new NewsLetter();
            $newsLetter->setName($this->request->getPost('name'));
            $newsLetter->setEmail($this->request->getPost('email'));
            $newsLetter->setGender($this->request->getPost('gender'));
            $newsLetter->setReceiveNews($this->request->getPost('receive_news') == 'on');

            try {
                $this->service->save($newsLetter);
                $this->sendEmail($newsLetter);
                $this->success("Obrigado por seu contato!");
                $this->redirect('contact/index');
            } catch (ValidationException $ex) {
                foreach ($ex->getErrors() as $er) {
                    $this->error($er->getMessage());
                }
                $this->view->instance = $newsLetter;
                $this->view->message = $this->request->getPost("mensagem");
                $this->view->pick('contact/index');
            } catch (MailException $ex) {
                $this->error("Não foi possível enviar o email, tente novamente.");
                $this->showError($ex);
            }
        } else {
            $this->redirect('contact/index');
        }
    }

    private function sendEmail(NewsLetter $n) {
        $mail = new MailService($this->company);
        $mail->sendContact($n->getEmail(), $n->getName(), "Sistema: Contato", $this->request->getPost("mensagem"));
    }

}
