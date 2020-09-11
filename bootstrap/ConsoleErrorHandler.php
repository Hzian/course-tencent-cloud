<?php

namespace Bootstrap;

use App\Library\Logger as AppLogger;
use Phalcon\Config as PhConfig;
use Phalcon\Logger\Adapter\File as PhLogger;
use Phalcon\Mvc\User\Component;

class ConsoleErrorHandler extends Component
{

    public function __construct()
    {
        set_error_handler([$this, 'handleError']);

        set_exception_handler([$this, 'handleException']);
    }

    public function handleError($severity, $message, $file, $line)
    {
        throw new \ErrorException($message, 0, $severity, $file, $line);
    }

    /**
     * @param \Throwable $e
     */
    public function handleException($e)
    {
        $config = $this->getConfig();

        $logger = $this->getLogger();

        $content = sprintf('%s(%d): %s', $e->getFile(), $e->getLine(), $e->getMessage());

        $logger->error($content);

        if ($config->get('env') == ENV_DEV) {
            echo $content;
        }
    }

    /**
     * @return PhConfig
     */
    protected function getConfig()
    {
        return $this->getDI()->get('config');
    }

    /**
     * @return PhLogger
     */
    protected function getLogger()
    {
        $logger = new AppLogger();

        return $logger->getInstance('console');
    }

}
