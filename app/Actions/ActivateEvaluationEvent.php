<?php

namespace App\Actions;

use App\Models\EvaluationEvent;
use App\Traits\Makeable;

class ActivateEvaluationEvent
{
    use Makeable;

    public function handle(EvaluationEvent $evaluationEvent): void
    {
        // Note: Only one evaluation event can be active at a time

        // Deactivate all other evaluation events
        EvaluationEvent::query()->update([
            'active' => false,
        ]);

        // Activate the given evaluation event
        $evaluationEvent->update([
            'active' => true,
        ]);

    }
}
