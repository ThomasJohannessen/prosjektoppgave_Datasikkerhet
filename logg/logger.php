<?php
use Monolog\Logger;
use Monolog\Handler\GelfHandler;
class AppLogger {
        private Logger $logger;
        function __construct(String $group) {
                $this->logger = new Logger($group);
                setupLogger();
        }

        private function setupLogger() {
                $port = 0;
                switch ($this->$logger->getName()) {
                        case "innlogging":
                                $port = 12201;
                                break;
                        default:
                                $port = 12210;
                                break;
                }

                $this->logger->pushHandler(
                        new GelfHandler(new Gelf\Publisher(new Gelf\Transport\UdpTransport("127.0.0.1", $port))));
        }

        public function getLogger() {
                return $this->logger;
        }
}

?>