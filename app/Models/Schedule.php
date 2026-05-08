<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'subject_name',
        'subject_code',
        'day_of_week',
        'start_time',
        'end_time',
        'room',
    ];}
