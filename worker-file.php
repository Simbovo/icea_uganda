<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

define('host', 'localhost');
define('port', '5672');
define('username', 'guest');
define('password', 'guest');


$connection = new AMQPStreamConnection(host, port, username, password);

$channel = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);

//$msg = new AMQPMessage('Hello World');
$data = implode(' ', array_slice($argv, 1));
if(empty($data)) $data = "Hello World!";
$msg = new AMQPMessage($data,
                        array('delivery_mode' => 2) # make message persistent
                      );



$channel->basic_publish($msg, '', 'hello');

echo " [x] Sent 'Hello World!'\n";

$channel->close();
$connection->close();
