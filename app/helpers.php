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

if (! function_exists('greeting')) {
    function greeting() {
        $hour = date('H');
        return ($hour > 17) ? trans("Good evening ") : (($hour > 12 && $hour <= 18) ? trans("Good afternoon ") : trans("Good morning "));
    }
}