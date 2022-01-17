<?php

namespace App\Observers;

use App\Models\Estimate;

class EstimateObserver
{
    public function creating(Estimate $estimate)
    {
        $estimate->employee_id = auth()->user()->employee_id;
    }
}
