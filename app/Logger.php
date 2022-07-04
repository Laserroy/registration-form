<?php

namespace App;

class Logger
{
    protected static string $logFile ='log.txt';

    public static function writeLine($data)
    {
        $logRecord = self::prepareLine($data);

        file_put_contents(self::$logFile, $logRecord, FILE_APPEND);
    }

    private static function prepareLine($data)
    {
        [$result, $errors] = $data;

        return date('d-m-Y h:i:sa') . " " . ($result ? "passed" : "error") . " " . implode(' ', $errors) . PHP_EOL;
    }
}