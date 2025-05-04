<?php

if (!function_exists('auto_asset')) {
    function auto_asset($path)
    {
        return app()->environment('production') ? auto_asset($path) : asset($path);
    }
}
