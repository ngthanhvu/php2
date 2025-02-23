<?php

namespace App\Models;

require_once "./env.php";
require_once "./vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Core\BladeServiceProvider;

class MailModel
{
    private $mailer;

    public function __construct()
    {
        $this->mailer = new PHPMailer(true);
        $this->configure();
    }

    private function configure()
    {
        try {
            // Server settings
            $this->mailer->isSMTP();
            $this->mailer->Host = $_ENV['MAIL_HOST'];
            $this->mailer->SMTPAuth = true;
            $this->mailer->Username = $_ENV['MAIL_USERNAME'];
            $this->mailer->Password = $_ENV['MAIL_PASSWORD'];
            $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mailer->Port = $_ENV['MAIL_PORT'];

            $this->mailer->CharSet = 'UTF-8';

            // Default sender
            $this->mailer->setFrom('noreply@admin.com', 'shopbanhang.online');
        } catch (Exception $e) {
            throw new Exception("Mailer configuration error: {$e->getMessage()}");
        }
    }

    public function send($to, $subject, $template, $data = [])
    {
        try {
            // Render nội dung email bằng Blade
            $body = BladeServiceProvider::renderMail("emails.$template", $data);

            $this->mailer->addAddress($to);
            $this->mailer->Subject = $subject;
            $this->mailer->Body = $body;
            $this->mailer->isHTML(true);
            $this->mailer->send();
        } catch (Exception $e) {
            throw new Exception("Message could not be sent. Mailer Error: {$this->mailer->ErrorInfo}");
        }
    }
}
