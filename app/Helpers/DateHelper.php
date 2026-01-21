<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    /**
     * Timezone untuk aplikasi (Makassar, Indonesia - WITA UTC+8)
     */
    const TIMEZONE = 'Asia/Makassar';

    /**
     * Get current date/time dengan timezone Makassar
     * 
     * @return Carbon
     */
    public static function now()
    {
        return Carbon::now(self::TIMEZONE);
    }

    /**
     * Get current date (start of day) dengan timezone Makassar
     * 
     * @return Carbon
     */
    public static function today()
    {
        return Carbon::now(self::TIMEZONE)->startOfDay();
    }

    /**
     * Parse date dengan timezone Makassar
     * 
     * @param string $date
     * @return Carbon
     */
    public static function parse($date)
    {
        return Carbon::parse($date, self::TIMEZONE);
    }

    /**
     * Hitung sisa hari dari hari ini sampai tanggal tertentu (inclusive)
     * Termasuk hari ini dalam perhitungan
     * 
     * @param string|Carbon $endDate
     * @return array ['days' => int, 'text' => string]
     */
    public static function calculateRemainingDays($endDate)
    {
        $today = self::today();
        $end = $endDate instanceof Carbon
            ? $endDate->copy()->startOfDay()
            : Carbon::parse($endDate, self::TIMEZONE)->startOfDay();

        if ($end->lt($today)) {
            // Sudah lewat
            $days = $end->diffInDays($today);
            return [
                'days' => -$days,
                'text' => 'Overdue ' . $days . ' days',
                'status' => 'overdue'
            ];
        } elseif ($end->eq($today)) {
            // Hari ini adalah hari terakhir
            return [
                'days' => 1,
                'text' => '1 day',
                'status' => 'today'
            ];
        } else {
            // Masih ada sisa hari (inclusive, termasuk hari ini)
            // Contoh: Hari ini 21 Jan, End 24 Jan
            // Sisa: 21, 22, 23, 24 = 4 hari
            $days = $today->diffInDays($end) + 1;
            return [
                'days' => $days,
                'text' => $days . ' days',
                'status' => 'upcoming'
            ];
        }
    }

    /**
     * Format date untuk display
     * 
     * @param string|Carbon $date
     * @param string $format
     * @return string
     */
    public static function format($date, $format = 'Y-m-d')
    {
        if (!$date) {
            return '';
        }

        $carbon = $date instanceof Carbon
            ? $date
            : Carbon::parse($date, self::TIMEZONE);

        return $carbon->format($format);
    }
}
