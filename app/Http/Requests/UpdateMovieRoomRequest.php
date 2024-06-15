<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMovieRoomRequest extends FormRequest
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
            'movie_id' => 'required|integer',
            'room_id' => 'required|integer',
            'slot_id' => 'required|integer',
            'date' => 'required|date|after_or_equal:today',
        ];
    }
    public function messages()
    {
        return [
            'movie_id.required' => 'L\'ID del film non puè essere vuoto',
            'movie_id.exists' => 'L\'ID del film non esiste',

            'room_id.required' => 'L\'ID della sala non puè essere vuoto',
            'room_id.exists' => 'L\'ID della sala non esiste',

            'slot_id.required' => 'L\'ID del slot non puè essere vuoto',
            'slot_id.exists' => 'L\'ID del slot non esiste',

            'date.required' => 'La data non puè essere vuota',
            'date.after_or_equal' => 'La data non puè essere inferiore o uguale alla data odierna',
            'date.date' => 'La data non ha un formato corretto',


        ];
    }
}
