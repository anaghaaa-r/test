<?php

use App\Models\Category;

function categories()
{
    $categories = Category::all();

    return $categories;
}