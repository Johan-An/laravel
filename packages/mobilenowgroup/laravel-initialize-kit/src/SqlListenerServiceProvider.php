<?php

namespace MobileNowGroup\LaravelInitializeKit;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class SqlListenerServiceProvider extends ServiceProvider
{
    public function register()
    {
        if (app()->isLocal()) {
            \DB::listen(function ($query) {
                if (!str_starts_with($query->sql, 'select')) {
                    return false;
                }

                $sql = Str::replaceArray('?', $query->bindings, $query->sql);

                $explainSql = sprintf('Explain %s', $sql);

                $explainResult = current(\DB::select($explainSql));

                if (is_null($explainResult->key)) {
                    logger()->channel('sql-optimization')->warning($sql);
                }
            });
        }
    }

}