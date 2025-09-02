<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviseTransactionRequest extends FormRequest
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
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'project' => 'required|string|max:255',
            'due_date' => 'required|date',
            'supplier' => 'required|string|max:255',
            'part_number' => 'required|string|max:255',
            'id_document' => 'required|integer|exists:documents,id',
            'revise' => 'required|integer|min:0',
            'doc_file' => 'required|string|max:255',
        ];
    }
}
