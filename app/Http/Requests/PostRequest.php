<?php

namespace App\Http\Requests;

class PostRequest extends Request
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

    public function postFillData($model) 
    {
    	$model = app($model);
    	return $model->modifyInput($this);
    }

    public function rules()
    {
    	return [];
    }
}
