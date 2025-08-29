<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'ticket_price' => 'required|numeric', // optional if using packages
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'draw_time' => 'nullable|date|after:end_date',
            'banners' => 'required|array|min:1',
            'banners.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'rules' => 'nullable|file|mimes:pdf,docx,txt|max:4096',
            'max_tickets_per_user' => 'required|integer|min:1',
        ];
    }
}
