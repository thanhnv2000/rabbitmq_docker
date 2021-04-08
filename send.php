<?php

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Exchange\AMQPExchangeType;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

// fanout
// $queue_name ='queue_taxi_1';
// $channel->queue_declare($queue_name, false, false, false, false);

// $channel->queue_bind($queue_name,'exchange.taxi1.fanout');
// $msg = new AMQPMessage('Hello World taxi1 ! ');
// $channel->basic_publish($msg, 'exchange.taxi1.fanout', $queue_name);

// echo " [x] Sent 'Hello World taxi1 !'\n";

// TOPIC
// $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
// $channel = $connection->channel();

// $queue_name ='queue_taxi_topic_5';
// $channel->queue_declare($queue_name, false, false, false, false);
// $channel->queue_bind($queue_name,'ex.taxi.topic5');

// $msg = new AMQPMessage('Hello World taxi1 ! ');
// $channel->basic_publish($msg, 'ex.taxi.topic5', 'queue*');


$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$queue_name ='queue_taxi_topic_7';
$channel->queue_declare($queue_name, false, false, false, false);
$channel->queue_bind($queue_name,'exchange.topic7');

$msg = new AMQPMessage('Hello World taxi1 ');
$channel->basic_publish($msg, 'exchange.topic7', 'BINDINGKEY.hihiehie');

echo " [x] Sent 'Hello World taxi1 !'\n";

$channel->close();
$connection->close();
?>