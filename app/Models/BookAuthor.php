<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class BookAuthor extends Model
{
    protected $table = 'book_author';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'book_id',
        'author_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'pivot',
        'created_at',
        'updated_at',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

}