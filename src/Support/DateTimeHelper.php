<?php

namespace Osnova\Support;

class DateTimeHelper
{
    /**
     * Create new instance of DateTimeImmutable from given timestamp (if possible).
     *
     * @param int|null $timestamp
     * @param string   $timezone  = 'Europe/Moscow'
     *
     * @return \DateTimeImmutable|null
     */
    public static function createFromTimestamp($timestamp, string $timezone = 'Europe/Moscow')
    {
        $value = intval($timestamp);

        if (!$value) {
            return;
        }

        return (new \DateTimeImmutable())
            ->setTimestamp($value)
            ->setTimezone(new \DateTimeZone($timezone));
    }
}
