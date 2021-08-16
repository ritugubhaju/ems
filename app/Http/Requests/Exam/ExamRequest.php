<?php

namespace App\Http\Requests\Exam;

use Illuminate\Foundation\Http\FormRequest;

class ExamRequest extends FormRequest
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
            'title'=>'required'
        ];

        return $rules;
    }

    public function data(){
        
        
        $inputs=[
            'title' => $this->get('title'),
            'content'   => $this->get('content'),
            'user_id'   => auth()->user()->id,
            'is_published' => ($this->get('is_published') ? $this->get('is_published') : '') == 'on' ? '1' : '0',
            'is_featured' => ($this->get('is_featured') ? $this->get('is_featured') : '') == 'on' ? '1' : '0'

        ];
      
        if ($this->has('publish')) {
            $inputs['is_published'] = 1;
        }

        return $inputs;
    }
}

