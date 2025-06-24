<?php

namespace App\Http\Requests;

use App\Models\Position;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePositionRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'reports_to' => [
                'nullable',
                // After preparation, this will be an integer ID
                'integer',
                'exists:positions,id',
                function ($attribute, $value, $fail) {
                    if (is_null($value)) {
                        if (Position::whereNull('reports_to')->exists()) {
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
