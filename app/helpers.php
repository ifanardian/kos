<?php

if (!function_exists('secure_asset')) {
    function secure_asset($path)
    {
        return app()->environment('production') ? secure_asset($path) : asset($path);
    }
}
