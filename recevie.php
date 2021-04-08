<?php

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Exchange\AMQPExchangeType;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();
// fanout
// $queue_name ='queue_taxi_5';
// $channel->queue_declare($queue_name, false, false, false, false);
// $exchange = AMQPExchangeType::FANOUT;
// $channel->exchange_declare('exchange.taxi1.fanout',$exchange, false, false, false);
// $channel->queue_bind($queue_name,'exchange.taxi1.fanout');

// echo " [*] Waiting for messages. To exit press CTRL+C\n";

// $callback = function ($msg) {
//     echo ' [x] Received ', $msg->body, "\n";
// };


// TOPIC
// $queue_name ='queue_taxi_topic_6';
// $channel->queue_declare($queue_name, false, false, false, false);
// $exchange = AMQPExchangeType::TOPIC;
// $channel->queue_bind($queue_name,'ex.taxi.topic5','queue*');


// echo " [*] Waiting for messages. To exit press CTRL+C\n";

// $callback = function ($msg) {
//     echo ' [x] Received ', $msg->body, "\n";
// };


// $channel->basic_consume($queue_name, '', false, true, false, false, $callback);




$queue_name ='queue_taxi_topic_7';
$channel->queue_declare($queue_name, false, false, false, false);
$exchange = AMQPExchangeType::TOPIC;
$channel->exchange_declare('exchange.topic7',$exchange, false, false, false);
$channel->queue_bind($queue_name,'exchange.topic7','BINDINGKEY.*');


echo " [*] Waiting for messages. To exit press CTRL+C\n";

$callback = function ($msg) {
    echo ' [x] Received ', $msg->body, "\n";
};


$channel->basic_consume($queue_name, '', false, true, false, false, $callback);

while ($channel->is_consuming()) {
    $channel->wait();
    echo 'run';
    usleep(1000000);
}

$channel->close();
$connection->close();
?>