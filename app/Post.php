<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Http\Requests\RequestTrait;
use \App\Http\Requests\PostRequest;

class Post extends Model
{

    use RequestTrait;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    protected $dates = ['date_from'];

    protected $fillable = [
        'title', 'subtitle', 'preview', 'images', 'meta_description', 'meta_keywords',
        'enabled', 'date_from', 'text'
    ];


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(\Illuminate\Http\Request $request)
    {
        return [
            'title'     => 'required',
            'subtitle'  => 'required',
            'preview'   => 'required',
            'text'      => 'required',
            'date_from' => 'required'
        ];
    }

    /**
     * Return the fields and values
     */
    public function modifyInput(PostRequest $request)
    {
        return [
            'title'             => $request->title,
            'subtitle'          => $request->subtitle,
            'images'            => $request->images,
            'text'              => $request->get('text'),
            'preview'           => $request->preview,
            'meta_description'  => $request->meta_description,
            'meta_keywords'     => $request->meta_keywords,
            'enabled'           => (bool)$request->enabled,
            'date_from'         => $request->date_from,
        ];
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;

        if (! $this->exists) {
            $this->setUniqueSlug($value, '');
        }
    }


    protected function setUniqueSlug($title, $extra)
    {
        $slug = str_slug($title.'-'.$extra);

        if (static::whereSlug($slug)->exists()) {
            $this->setUniqueSlug($title, $extra + 1);
            return;
        }

        $this->attributes['slug'] = $slug;
    }


    public function setContentRawAttribute($value)
    {
        $markdown = new Markdowner();

        $this->attributes['content_html'] = $markdown->toHTML($value);
    }


    public function getPublishDateAttribute($value)
    {
        return $this->published_at->format('M-j-Y');
    }


    public function getPublishTimeAttribute($value)
    {
        return $this->published_at->format('g:i A');
    }


    public function getContentAttribute($value)
    {
        return $this->text;
    }
}
