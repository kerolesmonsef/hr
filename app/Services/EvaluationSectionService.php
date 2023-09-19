<?php

namespace App\Services;

use App\Models\EvaluationSection;

class EvaluationSectionService
{
    public function store(array $data, $evaluation_id)
    {
        return EvaluationSection::query()->create([
            'title' => $data['title'],
            'evaluation_id' => $evaluation_id
        ]);
    }
}
