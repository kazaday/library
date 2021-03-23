<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    protected $fillable = ['first_name','second_name','last_name'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function books(){
        return $this->belongsToMany('App\Models\Books', 'author_book', 'book_id', 'author_id');

    }
}
