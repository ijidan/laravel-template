<?php

namespace App\Providers;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Str;

/**
 * SQL 记录
 * Class SqlLogServiceProvider
 * @package App\Providers
 */
class SqlLogServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     */
    public function boot() {
        DB::listen(function (QueryExecuted $query) {
            if ($query->time < $this->app['config']->get('logging.query.slower_than', 0)) {
                return;
            }
            $realSql = vsprintf(str_replace('?', '%s', $query->sql), collect($query->bindings)->map(function ($binding) {
                return is_numeric($binding) ? $binding : "'{$binding}'";
            })->toArray());

            $duration = $this->formatDuration($query->time / 1000);
            $content = [
                'database' => $query->connection->getDatabaseName(),
                'sql'      => $realSql,
                'duration' => $duration
            ];
            if (!Str::contains($realSql, 'telescope_entries')) {
                //$content = sprintf('[%s]-[%s] %s', $query->connection->getDatabaseName(), $duration, $realSql);
                Log::info('sql', $content);
            }
        });
    }

    /**
     * Format duration.
     * @param float $seconds
     * @return string
     */
    private function formatDuration(float $seconds): string {
        if ($seconds < 0.001) {
            return round($seconds * 1000000) . 'μs';
        } elseif ($seconds < 1) {
            return round($seconds * 1000, 2) . 'ms';
        }

        return round($seconds, 2) . 's';
    }
}
