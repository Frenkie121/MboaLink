<?php

use Carbon\Carbon;

if (! function_exists('formatedLocaleDate')) {
    function formatedLocaleDate(string $date) {
        $locale = app()->getLocale();
        Carbon::setLocale($locale);
        $format = $locale === 'en' ? 'F d, Y' : 'd M Y';
        return Carbon::parse($date)->translatedFormat($format);
    }
}