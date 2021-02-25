<?php

require '/var/www/html/composershit/vendor/autoload.php';
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\LogglyHandler;
use Monolog\Formatter\LogglyFormatter;
use Monolog\Handler\FingersCrossedHandler;
use Monolog\Handler\FingersCrossed\ErrorLevelActivationStrategy;
use Monolog\Handler\GelfHandler;
use Gelf\Message;
use Monolog\Formatter\GelfMessageFormatter;

function getLogger() {

        $logger = new Logger('sikkerhet');

        $logger->pushHandler(new StreamHandler('/var/www/html/composershit/logs/app.log', Logger::DEBUG));

        $transport = new Gelf\Transport\UdpTransport("127.0.0.1", 12201);
        $publisher = new Gelf\Publisher($transport);
        $handler = new GelfHandler($publisher, Logger::DEBUG);

        $logger->pushHandler($handler);

        $logger->pushHandler(new LogglyHandler('37bd52c9-726b-4ba1-9973-ed42a15392a4/tag/monolog', Logger::INFO));

        $printer = new StreamHandler('/var/www/html/composershit/logs/fingers.log');
        $fingers = new FingersCrossedHandler($printer, new ErrorLevelActivationStrategy(Logger::ERROR));
        $logger->pushHandler($fingers);
        $logger->pushProcessor(function ($record) {
                $record['extra']['user'] = 'tomhnatt';
                return $record;});
        
        return $logger;
}

?>