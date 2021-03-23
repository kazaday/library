<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['name','description','poster'];

    public function authors(){
        return $this->belongsToMany('App\Models\Author', 'author_book', 'book_id', 'author_id');
    }

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
