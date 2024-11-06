<?php

namespace App\Dtos;

class BookCreateOrUpdateDto
{
    private string $title;
    private string $author;
    private string $description;
    private int $publicationYear;

    public function __construct(
        string $title,
        string $author,
        string $description,
        int $publicationYear
    ) {
        $this->title = $title;
        $this->author = $author;
        $this->description = $description;
        $this->publicationYear = $publicationYear;
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'author' => $this->author,
            'description' => $this->description,
            'publication_year' => $this->publicationYear,
        ];
    }
}
