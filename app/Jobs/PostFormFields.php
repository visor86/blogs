<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Post;
use Illuminate\Contracts\Bus\SelfHandling;

class PostFormFields extends Job implements SelfHandling
{
    protected $id;

    protected $fieldList = [
        'title' => '',
        'subtitle' => '',
        'images' => '',
        'preview' => '',
        'text' => '',
        'meta_description' => '',
        'meta_keywords' => '',
        'date_from' => '',
        'enabled' => '1'
    ];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id = null)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $fields = $this->fieldList;

        if ($this->id) {
            $fields = $this->fieldsFromModel($this->id, $fields);
        }

        foreach ($fields as $fieldName => $fieldValue) {
            $fields[$fieldName] = old($fieldName, $fieldValue);
        }

        return $fields;
    }


    protected function fieldsFromModel($id, array $fields)
    {
        $post = Post::findOrFail($id);

        $fieldNames = array_keys($fields);

        $fields = ['id' => $id];
        foreach ($fieldNames as $field) {
            $fields[$field] = $post->{$field};
        }

        return $fields;
    }
}
