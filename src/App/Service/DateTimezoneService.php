<?php

namespace App\Service;

use DateTime;
use DateTimeZone;

class DateTimezoneService
{
    /**
     * @throws \Exception
     */
    public function calculateDateTimezoneDetails(string $dateInput, string $timezoneInput): array
    {
        $date = new DateTime($dateInput);
        $timezone = new DateTimeZone($timezoneInput);

        $offset = $timezone->getOffset($date) / 60;

        $february = new DateTime($dateInput);
        $february->setDate($february->format('Y'), 2, 1);
        $daysInFebruary = $february->format('t');

        $daysInMonth = $date->format('t');
        $monthName = $date->format('F');

        return [
            'offset' => $offset,
            'daysInFebruary' => $daysInFebruary,
            'monthName' => $monthName,
            'daysInMonth' => $daysInMonth,
            'timezone' => $timezoneInput
        ];
    }
}