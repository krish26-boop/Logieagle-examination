<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'student_id',
        'exam_id',
        'subject',
        'marks',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

   // Accessor to get grade
//    public function getGradeAttribute()
//    {
//        return Grade::where('from', '<=', $this->marks)
//                    ->where('to', '>=', $this->marks)
//                    ->first()
//                    ->grade ?? 'N/A'; // Return 'N/A' if no grade found
//    }
}
