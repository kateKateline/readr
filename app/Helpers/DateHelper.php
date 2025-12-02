<?php

use Carbon\Carbon;

function formatShortDate($date)
{
    $date = Carbon::parse($date);
    $diff = now()->diff($date);

    if ($diff->y > 0) return $diff->y . 'y';
    if ($diff->m > 0) return $diff->m . 'm';
    if ($diff->d >= 7) return floor($diff->d / 7) . 'w';
    if ($diff->d > 0) return $diff->d . 'd';
    if ($diff->h > 0) return $diff->h . 'h';
    if ($diff->i > 0) return $diff->i . 'min';

    return 'now';
}
