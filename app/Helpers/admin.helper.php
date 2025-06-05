<?php

if (!function_exists('getLevelName')) {
    function getLevelName($level)
    {
        switch ($level) {
            case 2:
                return 'Kepala Perpustakaan';
            case 3:
                return 'Admin Perpustakaan';
            default:
                return 'Tidak Dikenali';
        }
    }
}