<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4bb52af09118b1b44d44e6a2127df2f1
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PhpAmqpLib\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PhpAmqpLib\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-amqplib/php-amqplib/PhpAmqpLib',
        ),
    );

    public static $classMap = array (
        'FPDF' => __DIR__ . '/../..' . '/app/application/library/fpdf.php',
        'PDF_Javascript' => __DIR__ . '/../..' . '/app/application/library/PDF_Javascript.php',
        'PHPMailer' => __DIR__ . '/../..' . '/app/application/library/class.phpmailer.php',
        'PHPMailerOAuth' => __DIR__ . '/../..' . '/app/application/library/class.phpmaileroauth.php',
        'PHPMailerOAuthGoogle' => __DIR__ . '/../..' . '/app/application/library/class.phpmaileroauthgoogle.php',
        'POP3' => __DIR__ . '/../..' . '/app/application/library/class.pop3.php',
        'SMTP' => __DIR__ . '/../..' . '/app/application/library/class.smtp.php',
        'app\\application\\controller\\accountController' => __DIR__ . '/../..' . '/app/application/controller/accountController.php',
        'app\\application\\controller\\agentController' => __DIR__ . '/../..' . '/app/application/controller/agentController.php',
        'app\\application\\controller\\testApplication' => __DIR__ . '/../..' . '/app/application/library/testApplication.php',
        'app\\application\\controller\\transactionController' => __DIR__ . '/../..' . '/app/application/controller/transactionController.php',
        'app\\application\\library\\commonFunctions' => __DIR__ . '/../..' . '/app/application/library/commonFunctions.php',
        'app\\application\\model\\accountsMapper' => __DIR__ . '/../..' . '/app/application/model/accountsMapper.php',
        'app\\application\\model\\loadAppropriateContent' => __DIR__ . '/../..' . '/app/application/model/loadAppropriateContent.php',
        'app\\application\\model\\memberMapper' => __DIR__ . '/../..' . '/app/application/model/memberMapper.php',
        'app\\application\\model\\staffSetUp' => __DIR__ . '/../..' . '/app/application/model/staffSetUp.php',
        'application\\controller\\Mailer' => __DIR__ . '/../..' . '/app/application/controller/mailController.php',
        'application\\controller\\authController' => __DIR__ . '/../..' . '/app/application/controller/authController.php',
        'application\\controller\\companyController' => __DIR__ . '/../..' . '/app/application/controller/companyController.php',
        'application\\controller\\dataController' => __DIR__ . '/../..' . '/app/application/controller/dataController.php',
        'application\\controller\\documentController' => __DIR__ . '/../..' . '/app/application/controller/documentController.php',
        'application\\controller\\employeeController' => __DIR__ . '/../..' . '/app/application/controller/employeeController.php',
        'application\\controller\\feedsController' => __DIR__ . '/../..' . '/app/application/controller/feedsController.php',
        'application\\controller\\memberController' => __DIR__ . '/../..' . '/app/application/controller/memberController.php',
        'application\\controller\\risk' => __DIR__ . '/../..' . '/app/application/controller/riskController.php',
        'application\\controller\\settingsController' => __DIR__ . '/../..' . '/app/application/controller/settingsController.php',
        'application\\library\\Logger' => __DIR__ . '/../..' . '/app/application/library/Logger.php',
        'application\\library\\PrivilegedUser' => __DIR__ . '/../..' . '/app/application/library/PrivilegedUser.php',
        'application\\library\\Role' => __DIR__ . '/../..' . '/app/application/library/Role.php',
        'application\\model\\Config' => __DIR__ . '/../..' . '/app/application/model/Config.php',
        'application\\model\\DbConnection' => __DIR__ . '/../..' . '/app/application/model/DbConnection.php',
        'feeds_FeedbacksModel' => __DIR__ . '/../..' . '/app/application/controller/feeds_FeedbacksModel.class.php',
        'feeds_MembersModel' => __DIR__ . '/../..' . '/app/application/model/feeds_MembersModel.class.php',
        'phpmailerException' => __DIR__ . '/../..' . '/app/application/library/class.phpmailer.php',
        'user_controlSyssettingsModel' => __DIR__ . '/../..' . '/app/application/model/user_controlSyssettingsModel.class.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4bb52af09118b1b44d44e6a2127df2f1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4bb52af09118b1b44d44e6a2127df2f1::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4bb52af09118b1b44d44e6a2127df2f1::$classMap;

        }, null, ClassLoader::class);
    }
}
