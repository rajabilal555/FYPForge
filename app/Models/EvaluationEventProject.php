<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EvaluationEventProject extends Pivot
{
    protected $casts = [
        'evaluation_date' => 'datetime',
    ];
}
