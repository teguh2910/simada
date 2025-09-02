<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'project' => 'required|string|max:255',
            'due_date' => 'required|date|after:today',
            'supplier' => 'required|string|max:255',
            'part_number' => 'required|string|max:255',
            'kind_doc' => 'required|in:SPTT-1,SPTT-2,SPTT-3',
        ];
    }
}
