<?php

namespace App\Dtos;

class BooksSearchDto 
{
    private ?string $search;
    private ?int $publicationYear;
    private int $page;
    private int $limit;

    public function __construct(array $data)
    {
        $this->search = $data['search'] ?? null; ;
        $this->publicationYear = $data['publication_year'] ?? null;
        $this->page = $data['page'] ?? 1;
        $this->limit = $data['limit'] ?? 10;
    }

    public function getSearch(): ?string
    {
        return $this->search;
    }

    public function getPublicationYear(): ?int
    {
        return $this->publicationYear;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }
}