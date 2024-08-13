<?php
if (!function_exists('canAccessPage')) {
    function canAccessPage($rol, $page)
    {
        return $rol->pages()->where('page', $page)->exists();
    }
}
