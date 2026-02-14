<?php

namespace App;

use Illuminate\Notifications\DatabaseNotification as BaseDatabaseNotification;

class CustomDatabaseNotification extends BaseDatabaseNotification
{
    /**
     * SQL Server datetime2(7) may return 7 fractional digits.
     * PHP/Carbon expects max 6 microseconds -> trim extra digits safely.
     */
    protected function asDateTime($value)
    {
        if (is_string($value)) {
            // 2026-02-13 20:25:05.6000000 -> 2026-02-13 20:25:05.600000
            $value = preg_replace('/\.(\d{6})\d+$/', '.$1', $value);
        }

        return parent::asDateTime($value);
    }

    protected $casts = [
        'data'       => 'array',
        'read_at'    => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
