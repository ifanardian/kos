<?php

if (!function_exists('asset')) {
    function asset($path)
    {
        return app()->environment('production') ? asset($path) : asset($path);
    }
}
