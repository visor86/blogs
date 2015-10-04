<?php

namespace App\Http\Requests;

class PostCreateRequest extends Request
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
        return [
            'title'     => 'required',
            'subtitle'  => 'required',
            'preview'   => 'required',
            'text'      => 'required',
            'date_from' => 'required'
        ];
    }


    public function postFillData()
    {
        return [
            'title'             => $this->title,
            'subtitle'          => $this->subtitle,
            'images'            => $this->images,
            'text'              => $this->get('text'),
            'preview'           => $this->preview,
            'meta_description'  => $this->meta_description,
            'meta_keywords'     => $this->meta_keywords,
            'enabled'           => (bool)$this->enabled,
            'date_from'         => $this->date_from,
        ];
    }
}
