<?php

namespace App\Services;

class MessageService
{
    public static function success($message)
    {
        self::message('success', $message);
    }

    public static function error($message)
    {
        self::message('error', $message);
    }

    public static function warning($message)
    {
        self::message('warning', $message);
    }

    public static function info($message)
    {
        self::message('info', $message);
    }

    public static function message($type = 'success', $message)
    {
        session()->flash('message', [
            'type' => $type,
            'message' => $message,
        ]);
    }
}
