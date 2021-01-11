<?php

namespace Iliah\Core\Components\Logger;

use Psr\Log\AbstractLogger;

class Logger extends AbstractLogger
{

    protected static $instance;
    private $path = '/var/log/log.log';

    private $template = "{moment}, {level}, {message}, {context}";


    public static function getInstance()//, LoggerInterface $logger = null)
    {
        if (self::$instance === null) {
            self::$instance = new self();//, $logger);
        }

        return self::$instance;
    }

    private function __construct()
    {
        //$this->path = $path;
        if (!file_exists($this->path))
        {
            touch($this->path);
        }
    }

    private function currentTime()
    {
        return (new \DateTime())->format('Y-m-d H:i:s');
    }
    /**
     * @inheritDoc
     */
    public function log($level, $message, array $context = array())
    {
        file_put_contents($this->path, trim(strtr($this->template, [
        '{moment}' => $this->currentTime(),
        '{level}' => $level,
        '{message}' => $message,
        '{context}' => json_encode($context)
        ])) . "\n", FILE_APPEND);
    }

}