<?php

namespace App\Http\Requests;

use App\Models\Position;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePositionRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        $positionId = $this->route('position');

        return [
            'name' => [
                'sometimes',
                'string',
                Rule::unique('positions')->ignore($positionId),
            ],
            'reports_to' => [
                'nullable',
                // After preparation, this will be an integer ID
                'integer',
                'exists:positions,id',
                Rule::notIn([$positionId]),
                function ($attribute, $value, $fail) use ($positionId) {
                    if (is_null($value)) {
                        if (Position::whereNull('reports_to')->where('id', '!=', $positionId)->exists()) {
                            $fail('A CEO already exists. Only one position can have no one to report to.');
                        }
                    }
                },
            ],
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->has('reports_to') && is_string($this->reports_to)) {
            $reportingPosition = Position::where('name', $this->reports_to)->first();
            
            if ($this->reports_to !== '' && !$reportingPosition) {
                // This will trigger a validation error
                $this->merge(['reports_to' => -1]);
            } else {
                $this->merge([
                    'reports_to' => $reportingPosition ? $reportingPosition->id : null,
                ]);
            }
        }
    }
}
