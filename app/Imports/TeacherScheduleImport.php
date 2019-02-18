<?php

namespace App\Imports;

use App\TeacherSchedule;
use App\Teacher;
use Maatwebsite\Excel\Concerns\ToModel;
use Auth;

class TeacherScheduleImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $id = Auth::user()->id;
        $teacher = Teacher::where('user_id', $id)->first();
        $UNIX_DATE = ((float)$row[2] - 25569) * 86400;

        if($row[0] != '#'){
           return new TeacherSchedule([
                'teacher_id' => $teacher->id,
                'status' => '0',
                'schedule_date' => gmdate("Y-m-d H:i:s", (int)$UNIX_DATE),
            ]); 
        }
    }
}
