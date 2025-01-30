<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'exam_name',
        'passing_marks',
        'class'
    ];

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }
}
