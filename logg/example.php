<?php
require __DIR__.'/vendor/autoload.php';
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\LogglyHandler;
use Monolog\Formatter\LogglyFormatter;
use Monolog\Handler\FingersCrossedHandler;
use Monolog\Handler\FingersCrossed\ErrorLevelActivationStrategy;
use Monolog\Handler\GelfHandler;
use Gelf\Message;
use Monolog\Formatter\GelfMessageFormatter;

$logger = new Logger('sikkerhet');

$logger->pushHandler(new StreamHandler(__DIR__.'logs/app.log', Logger::DEBUG));

$transport = new Gelf\Transport\UdpTransport("127.0.0.1", 12201);
$publisher = new Gelf\Publisher($transport);
$handler = new GelfHandler($publisher, Logger::DEBUG);

$logger->pushHandler($handler);

$logger->pushHandler(new LogglyHandler('37bd52c9-726b-4ba1-9973-ed42a15392a4/tag/monolog', Logger::INFO));

$printer = new StreamHandler(__DIR__.'/logs/fingers.log');
$fingers = new FingersCrossedHandler($printer, new ErrorLevelActivationStrategy(Logger::ERROR));
$logger->pushHandler($fingers);
$logger->pushProcessor(function ($record) {
        $record['extra']['user'] = 'tomhnatt';
        return $record;});

$logger->info('First message');
$logger->warning('First warning', ['brukernavn' => 'michal', 'system' => 'test']);
$logger->info('Second info');
$logger->error('Big error occured!');
$logger->info('Third info');
?>