<?php

require_once 'Config.php';
require_once 'exceptions/MailException.php';
require_once 'exceptions/ValidationException.php';

/**
 * Used to send email using gmail.
 * Attention: only construct an instance if you are sending email,
 * to improve memory uses.
 *
 * @author luis
 */
class MailService {

    /**
     * @var Company
     */
    private $company;

    /**
     * @var PHPMailer
     */
    private $mailer;

    function __construct(Company $company) {

        $config = Config::getInstance();

        $this->mailer = new PHPMailer();

        $this->mailer->IsSMTP(); // telling the class to use SMTP
        $this->mailer->SMTPDebug = 2; // enables SMTP debug information (for testing)

        $this->mailer->SMTPAuth = true; // enable SMTP authentication
        $this->mailer->SMTPSecure = "tls"; // sets the prefix to the servier
        $this->mailer->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
        $this->mailer->Port = 587; // set the SMTP port for the GMAIL server
        $this->mailer->Username = $config['email']['email']; // GMAIL username
        $this->mailer->Password = $config['email']['passwd']; // GMAIL password
        $this->company = $company;
    }

    public function sendContact($mail, $name, $subject, $message) {

        $this->validateContact($mail, $name, $subject, $message);

        $this->mailer->AltBody = "To view the message, please use an HTML compatible email viewer!";
        $this->mailer->Subject = 'Sistema: Contato de "'.$name.'"';
        $this->mailer->MsgHTML("<strong>Contato de \"" . $name . "\" com a seguinte mensagem:</strong><br />" . $message);

        $this->mailer->AddAddress($this->company->getContact()->getEmail(), $this->company->getName());

        $this->mailer->SetFrom($mail, $name);

        $this->mailer->AddReplyTo($mail, $name);

        $this->send();
    }

    private function send() {
        if (!$this->mailer->Send()) {
            throw new MailException("Failed to send email with error:'" . $mail->ErrorInfo . "'");
        }
    }

    private function defaultConfig() {

        $this->mailer->SetFrom($this->company->getContact()->getEmail(), $this->company->getName());

        $this->mailer->AddReplyTo($this->company->getContact()->getEmail(), $this->company->getName());
    }

    public function validateContact($mail, $name, $subject, $message) {

        $v = new ValidationException();

        if ($mail == "") {
            $v->addError("Insira um email válido");
        } else if (!StringValidation::checkEmail($mail)) {
            $v->addError("Insira um email válido");
        }

        if ($name == "") {
            $v->addError("Insira um nome");
        }

        if ($subject == "") {
            $v->addError("Insira um assunto");
        }

        if (trim($message) == "") {
            $v->addError("Insira uma mensagem");
        }

        if (!$v->isEmtpy()) {
            throw $v;
        }
    }

}
