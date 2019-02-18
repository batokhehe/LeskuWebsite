<?php

namespace App\Exports;

use App\TeacherSchedule;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use DateTime;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;

class TeacherScheduleExport implements FromCollection, WithColumnFormatting, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TeacherSchedule::where('id', '1')->get();
    }

    public function map($teacher_schedule): array
    {
        return [
            '1',
            '',
            Date::dateTimeToExcel($teacher_schedule->created_at),
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            '',
            'Schedule Date',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_DATE_DATETIME,
        ];
    }
}
