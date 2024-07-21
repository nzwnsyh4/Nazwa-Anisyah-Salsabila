<?php

use Carbon\Carbon;

function formatRupiah($angka)
{
    $rupiah = number_format($angka, 0, ',', '.');
    return 'Rp ' . $rupiah;
}


function formatTime($date, $format = '%d %B %Y')
{
    $originalDate = $date;
    $formattedDate = Carbon::parse($originalDate)->formatLocalized($format);

    return $formattedDate; // Output: 24 Agustus 2023
}


function formatDate($time, $format = 'j-M-y')
{

    $carbonDate = Carbon::parse($time);
    $formattedDate = $carbonDate->format($format);
    return $formattedDate;
}

function Counting($start, $end)
{

    $start = Carbon::parse($start);
    $end = Carbon::parse($end);

    $diff = $start->diff($end);
    $selisihWaktu = $diff->h . 'h ' . $diff->i . 'm';

    return $selisihWaktu;
}
function removeUnderscore($string)
{
    $cleaned_text = str_replace(' ', ' ', ucwords(str_replace('_', ' ', $string)));
    return $cleaned_text;
}
