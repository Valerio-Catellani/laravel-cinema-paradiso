<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomRequest extends FormRequest
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
        return [
            'name' => 'required|max:255|min:3',
            'alias' => 'required|max:255',
            'hex_color' => 'nullable|max:7',
            'seats' => 'required|integer',
            'base_price' => 'required|numeric',
            'room_image' => 'nullable',
            'isense' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Il nome è obbligatorio',
            'name.min' => 'Il nome deve avere almeno :min caratteri',
            'name.max' => 'Il nome deve avere massimo :max caratteri',
            'alias.required' => 'L\'alias è obbligatorio',
            'alias.max' => 'L\'alias deve avere massimo :max caratteri',
            'hex_color.max' => 'Il colore hex deve avere massimo :max caratteri',
            'seats.required' => 'I posti sono obbligatori',
            'base_price.required' => 'Il prezzo base è obbligatorio',
            'room_image.max' => 'L\'immagine della stanza deve avere massimo :max caratteri',
            'isense.required' => 'Isense deve essere scelto',
        ];
    }
}
