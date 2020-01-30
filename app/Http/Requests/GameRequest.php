<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GameRequest extends FormRequest
{
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
             'title' => 'required|string|unique:games,title',
             'description' => 'required|string',
             'complexity' => 'required|min:1|max:10',
             'isActive' => 'required|boolean'
         ];

        switch ($this->getMethod())
        {
          case 'POST':
            return $rules;
          case 'PUT':
            return [
              'game_id' => 'required|integer|exists:games,id', //должен существовать
              'title' => [
                'required',
                Rule::unique('games')->ignore($this->title, 'title') //должен быть уникальным, за исключением себя же
              ]
            ] + $rules;
          case 'DELETE':
            return [
                'game_id' => 'required|integer|exists:games,id'
            ];
        }
    }
}
