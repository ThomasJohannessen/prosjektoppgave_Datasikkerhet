<?php 
require '/var/www/html/steg2/prosjektoppgave_Datasikkerhet/composer/vendor/autoload.php';
use Monolog\Logger;
use Monolog\Handler\GelfHandler;
use Monolog\Handler\StreamHandler;
class AppLogger {
        private $logger;
        function __construct(String $group) {
                $this->logger = new Logger($group);
                $this->setupLogger();
        }

        private function setupLogger() {
                $port = 0;
                switch ($this->logger->getName()) {
                        case "brukertilgang":
                                $port = 12201;
                                break;
                        case "meldinger":
                                $port = 12202;
                                break;
                        default:
                                $port = 12210;
                                break;
                }

                $this->logger->pushHandler(
                        new GelfHandler(new Gelf\Publisher(new Gelf\Transport\UdpTransport("127.0.0.1", $port))));
        } 

        public static function getIPAddress() { 
                $ip; 
                if(!array_key_exists('HTTP_CLIENT_IP', $_SERVER)) {
                        $_SERVER['HTTP_CLIENT_IP'] = false;
                }
                if(!array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
                        $_SERVER['HTTP_X_FORWARDED_FOR'] = false;
                }

                if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                        $ip = $_SERVER['HTTP_CLIENT_IP'];
                    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                    } else {
                        $ip = $_SERVER['REMOTE_ADDR'];
                    }
                return $ip;  
        }  

        public function getLogger() {
                return $this->logger;
        }
}
?>