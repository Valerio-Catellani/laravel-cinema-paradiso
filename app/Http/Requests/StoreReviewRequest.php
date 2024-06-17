<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
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
            'author' => 'required|max:200|min:3',
            'movie_id' => 'required',
            'date' => 'required',
            'content' => 'required',
            'rating' => 'nullable|numeric|between:0,10',
        ];
    }
    public function messages()
    {
        return [
            'author.required' => 'Il nome è obbligatorio',
            'author.min' => 'Il nome deve avere almeno :min caratteri',
            'author.max' => 'Il nome deve avere massimo :max caratteri',
            'date.required' => 'La data è obbligatoria',
            'date.date_format' => 'La data deve essere nel formato :format',
            'content.required' => 'Il contenuto è obbligatorio',
            'rating.between' => 'Il valore deve essere compreso tra :min e :max',
            'movie_id.required' => 'Il film è obbligatorio',
            'movie_id.exists' => 'Il film selezionato non esiste',
        ];
    }
}
