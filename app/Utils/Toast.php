<?php

namespace App\Utils;


class Toast
{
    public static function info(object $ob, $message)
    {
        $ob->dispatch(
            'toast',
            type: 'info',
            message: $message,
        );
    }

    public static function success(object $ob, $message)
    {
        $ob->dispatch(
            'toast',
            type: 'success',
            message: $message,
        );
    }

    public static function warning(object $ob, $message)
    {
        $ob->dispatch(
            'toast',
            type: 'warning',
            message: $message,
        );
    }

    public static function error(object $ob, $message)
    {
        $ob->dispatch(
            'toast',
            type: 'error',
            message: $message,
        );
    }
}
