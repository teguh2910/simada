<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRFQRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date|after:yesterday', // Allow today for updates
            'project' => 'nullable|string|max:255',
            'part_number' => 'nullable|string|max:255',
            'attachments' => 'nullable|array|max:5',
            'attachments.*' => 'file|mimes:pdf,doc,docx,xls,xlsx,txt,jpg,jpeg,png|max:10240', // 10MB max per file
            'suppliers' => 'nullable|array',
            'suppliers.*' => 'exists:suppliers,id',
            'send_email' => 'nullable|boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'attachments.max' => 'You can upload a maximum of 5 files.',
            'attachments.*.file' => 'Each attachment must be a valid file.',
            'attachments.*.mimes' => 'Each attachment must be a file of type: PDF, DOC, DOCX, XLS, XLSX, TXT, JPG, JPEG, PNG.',
            'attachments.*.max' => 'Each attachment may not be greater than 10MB.',
        ];
    }
}
