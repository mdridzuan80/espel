<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class AppNotify
{
    private $CI;
    private $type;
    private $mail;
    public function __construct()
    {
        $this->CI = &get_instance();
        $this->type = "email";
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function send(array $attr)
    {
        if ($this->type == "email") {
            $this->CI->load->model("mailconf_model", "mailconf");
            $mail_config = $this->CI->mailconf->get_by("status", 1);

            if ($mail_config) {
                $this->mail = new PHPMailer(true);
                $this->mail_config($mail_config);
                $this->reset($this->mail);
                $this->mail_recipient($attr);

                try {

                    //Attachments
                    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                    //Content
                    $this->mail->isHTML(true);                                  // Set email format to HTML
                    $this->mail->Subject = $attr['subject'];
                    $this->mail->Body = $attr['body'];
                    $this->mail->AltBody = htmlentities($attr['body']);

                    $this->mail->send();
                    return true;
                    //echo 'Message has been sent';
                } catch (Exception $e) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $this->mail->ErrorInfo;
                    return false;
                }
            } else {
                return false;
            }
        }
    }

    private function mail_config($config)
    {
        //Server settings
        $this->mail->SMTPDebug = $config->debug;                             // Enable verbose debug output
        $this->mail->isSMTP();
        $this->mail->SMTPAutoTLS = false;                                      // Set mailer to use SMTP
        $this->mail->Host = $config->host;  // Specify main and backup SMTP servers
        $this->mail->SMTPAuth = ($config->auth == 'T') ? true : false;                               // Enable SMTP authentication
        $this->mail->Username = $config->user;                 // SMTP username
        $this->mail->Password = $config->pass;                        // SMTP password

        if ($config->secure != 'NONE')
            $this->mail->SMTPSecure = $config->secure;                            // Enable TLS encryption, `ssl` also accepted

        $this->mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ];

        $this->mail->Port = $config->port;                                  // TCP port to connect to
        $this->mail->setFrom($config->from, $config->nama);
        $this->mail->addReplyTo($config->from, $config->nama);
    }

    private function mail_recipient(array $attr)
    {
        //Recipients
        if (is_array($attr['to'])) {
            foreach ($attr['to'] as $to) {
                $this->mail->addAddress($to);               // Name is optional
            }
        } else {
            $this->mail->addAddress($attr['to']);
        }

        if (isset($attr['cc'])) {
            if (is_array($attr['cc'])) {
                foreach ($attr['cc'] as $cc) {
                    $this->mail->addCC($cc);               // Name is optional
                }
            } else {
                $this->mail->addCC($attr['cc']);
            }
        }

        if (isset($attr['bcc'])) {
            if (is_array($attr['bcc'])) {
                foreach ($attr['bcc'] as $bcc) {
                    $this->mail->addBCC($bcc);               // Name is optional
                }
            } else {
                $this->mail->addBCC($attr['bcc']);
            }
        }
    }

    private function reset($mail)
    {
        $mail->clearAddresses();
        $mail->clearCCs();
        $mail->clearBCCs();
        $mail->clearReplyTos();
        $mail->clearAllRecipients();
        $mail->clearAttachments();
        $mail->clearCustomHeaders();
    }

    public function test_send($mail_config, $attr)
    {
        if ($this->type == "email") {
            if ($mail_config) {
                $this->mail = new PHPMailer(true);
                $this->mail_config($mail_config);
                $this->reset($this->mail);
                $this->mail_recipient($attr);
                try {

                    //Attachments
                    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                    //Content
                    $this->mail->isHTML(true);                                  // Set email format to HTML
                    $this->mail->Subject = $attr['subject'];
                    $this->mail->Body = $attr['body'];
                    $this->mail->AltBody = htmlentities($attr['body']);

                    $this->mail->send();
                    return true;
                    //echo 'Message has been sent';
                } catch (Exception $e) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $this->mail->ErrorInfo;
                    return false;
                }
            } else {
                return false;
            }
        }
    }
}