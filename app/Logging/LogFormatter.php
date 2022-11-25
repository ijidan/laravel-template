<?php

namespace App\Logging;

use Illuminate\Log\Logger;
use Monolog\Formatter\LineFormatter;
use App\Repository\UniContextRepo;
use Monolog\Formatter\JsonFormatter;

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
            //$handler->setFormatter(new LineFormatter($format,'Y-m-d H:i:s'));

            $record = [
                'datetime'   => '%datetime%',
                'channel'    => '%channel%',
                'level_name' => '%level_name%',
                'message'    => '%message%',
                'context'    => '%context%',
                'extra'      => '%extra%'
            ];
            $format = new JsonFormatter();
            $format->includeStacktraces(true);
            $format->setDateFormat('Y-m-d H:i:s');
            $format->format($record);
            $handler->setFormatter($format);
            $handler->pushProcessor(function ($record) {
                $record['id'] = uuid_create(UUID_TYPE_TIME);
                $context = $record['context'];
                if (isset($context['log_type'])) {
                    $type = $context['log_type'];
                    unset($context['log_type']);
                } else {
                    $type = 'info';
                }
                $record['type'] = $type;
                return $record;
            });
        }
    }
}
