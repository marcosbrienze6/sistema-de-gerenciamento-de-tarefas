<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        if ($this->isMethod('post')) {
            return [
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'type' => 'required|string|max:255',
            ];
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            return [
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string|max:255',
                'type' => 'nullable|string|max:255',
            ];
        }
        return [];
    }
}
