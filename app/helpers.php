<?php

function checked($value)
{
    return $value ? 'checked' : '';
}

function page_image($value = null, $resize = false)
{
    if (empty($value)) {
        $value = config('blog.page_image');
    }
    if (! starts_with($value, 'http') && $value[0] !== '/') {
        $value = config('blog.uploads.webpath') . ($resize ? '/thumb/' : '/') . $value;
    }

    return $value;
}