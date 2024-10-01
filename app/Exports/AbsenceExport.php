<?php

namespace App\Exports;

use App\Models\Absence;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AbsenceExport implements FromCollection, WithHeadings
{
    protected $absences;

    public function __construct($absences)
    {
        $this->absences = $absences;
    }

    public function collection()
    {
        // Map over the absences and format the data for export
        return $this->absences->map(function ($absence) {
            return [
                'id' => $absence->id,
                'student_name' => $absence->student ? $absence->student->name : 'No Student',
                'grade_name' => $absence->student && $absence->student->grade ? $absence->student->grade->name : 'No Grade',
                'date' => $absence->date,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Student Name',
            'Gradeo',
            'Date',
        ];
    }
}
