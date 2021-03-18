<?php

if (! function_exists('swal')) {
    /**
     * swal.
     *
     * @param  string|null  $message
     * @param  string|null  $title
     */
    function swal(string $message = null, string $title = null)
    {
        $notify = app('notify');

        if (! is_null($message)) {
            return $notify->success($message, $title);
        }

        return $notify;
    }
}
