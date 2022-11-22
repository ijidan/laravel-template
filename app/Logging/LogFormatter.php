<?php

namespace App\Logging;

use Illuminate\Log\Logger;
use Monolog\Formatter\LineFormatter;
use App\Repository\UniContextRepo;

/**
 * Class LogFormatter
 */
class LogFormatter {

    /**
     * @param Logger $logger
     * @return void
     */
    public function __invoke(Logger $logger) {
        /** @var  \Monolog\Handler\RotatingFileHandler $handler */
        foreach ($logger->getHandlers() as $handler) {
            $uniContext = new UniContextRepo();
            $uuid = $uniContext->getUuid();
            $rawFormat = '[%datetime%] %channel%.%level_name%: %message% %context% %extra%';
            $format = sprintf('%s %s%s', $uuid, $rawFormat, PHP_EOL);
            $handler->setFormatter(new LineFormatter($format,'Y-m-d H:i:s'));
        }
    }
}
