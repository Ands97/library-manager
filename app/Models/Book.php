<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'description',
        'publication_year'
    ];

    public function scopeByAuthor(Builder $query, string $author): Builder
    {
        return $query->where('author', $author);
    }

    public function scopeByPublicationYear(Builder $query, int $year): Builder
    {
        return $query->where('publication_year', $year);
    }

    public function scopeBySearch(Builder $query, string $search): Builder
    {
        return $query->where('title', 'like', "%$search%")
            ->orWhere('author', 'like', "%$search%");
    }
}
