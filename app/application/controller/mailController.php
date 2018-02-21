<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of mailController
 * Used to send emails
 * @author Allan Wiz
 */

namespace application\controller;

use application\model\DbConnection;

class Mailer
{

    private $dbh;
    private $sender, $port, $host, $user_id, $password, $sender_mail;
    private $mailer;

    public function __construct()
    {
        $this->dbh = DbConnection::getInstance();
        $this->configure();
    }

    /**
     * Mail configs done here
     */
    private function configure()
    {

        $QryStr = "SELECT SENDER, PORT,HOST, USER_ID,PASSWRD, EMAIL FROM SYSSETTINGS";
        try {
            $stmt = $this->dbh->dbConn->prepare($QryStr);
            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_OBJ);

            $this->sender = $result->sender;
            $this->port = $result->port;
            $this->host = $result->host;
            $this->user_id = $result->user_id;
            $this->password = $result->password;
            $this->sender_mail = $result->email;
        } catch (\PDOException $ex) {
            $ex->getMessage();
        }
    }

    /**
     *
     * @param string $subject
     * @param string $email
     * @param string $message_body
     * @return boolean
     *
     * all mails go through this method
     */
    public function sendEmails($subject, $emails, $message_body)
    {
        try {
            $this->mailer = new \PHPMailer();

            $this->mailer->IsSMTP();
            $this->mailer->SMTPAuth = true;
            $this->mailer->SMTPDebug = false;
            $this->mailer->SMTPSecure = 'tls';
            $this->mailer->Host = $this->host;
            $this->mailer->Port = $this->port;
            $this->mailer->Username = $this->user_id;
            $this->mailer->Password = "W@rt1n1A";

            foreach (explode(';', $emails) as $email) {

                $this->mailer->AddAddress($email);
            }
            //$this->mailer->AddAddress($email);

            $this->mailer->SetFrom($this->user_id, $this->sender);

            $this->mailer->AddReplyTo($this->sender_mail, $this->sender);
            $this->mailer->Subject = $subject;
            $this->mailer->Body = $message_body;

            $this->mailer->IsHTML(true);
            $this->mailer->WordWrap = 50;
            $this->mailer->AltBody = "Please use html compatible browser";

            $ok = $this->mailer->Send();

            if ($ok) {
                return true;
                $log = $this->log_emails($sender_mail, $email, $subject, $message_body);
            } else {
                return false;
            }
        } catch (\phpmailerException $e) {
            echo $e->getMessage();
        }
    }

    private function log_emails($fromname, $toname, $subject, $email)
    {
        $QryStr = "insert into emails (fromname, toname, subject, email, out)
        values(:fromname, :toname, :subject, :email, :out)";

        try {
            $stmt = $this->dbh->dbConn->prepare($QryStr);
            $params(array(':fromname' => $fromname, ':toname' => $toname, ':subject' => $subject, ':email' => $email, ':out' => 1));
            $stmt->execute($params);
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function send_sms($sms_message, $destination)
    {

        $_serviceUrl = "http://api.infobip.com/api/sendsms/plain?user=wizglobal&password=karanjag&GSM=" . $destination . "&sender=paam&SMSText=" . urlencode($sms_message) . "&type=longSMS";

        //die($_serviceUrl);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $_serviceUrl);
        //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data_json)));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        //curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $dt = new \DateTime();
        try{
            $QryStr = "INSERT INTO OUT_GOING (TYPE_OF_ENQ, PHONE, SMSMSG,OPERATOR, T_DATE, T_TIME)
                        values(:type_of_enq, :phone_no, :message, :operator, :t_date, :time_stamp)";
            $sth = $this->dbh->dbConn->prepare($QryStr);
            $sth->bindValue(":type_of_enq", 'M-PESA', \PDO::PARAM_STR);
            $sth->bindParam(":phone_no", $destination, \PDO::PARAM_STR);
            $sth->bindParam(":message", $sms_message, \PDO::PARAM_STR);
            $sth->bindValue(":operator", 'SAFARICOM', \PDO::PARAM_STR);
            $sth->bindValue(":t_date", $dt->format('Y-m-d'), \PDO::PARAM_STR);
            $sth->bindValue(":time_stamp", $dt->format('Y-m-d h:i:s a'), \PDO::PARAM_STR);
            $sth->execute();
        }catch (\PDOException $ex){
            echo $ex->getMessage();
        }

        return json_encode($response);
    }

}
