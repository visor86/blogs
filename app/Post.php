<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
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

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;

        if (! $this->exists) {
            $this->attributes['slug'] = str_slug($value);
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
