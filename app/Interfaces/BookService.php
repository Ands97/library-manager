<?php

namespace App\Interfaces;

use App\Dtos\BookCreateOrUpdateDto;
use App\Dtos\BooksSearchDto;
use App\Models\Book;
use Illuminate\Pagination\LengthAwarePaginator;

interface BookService
{
    public function getAllBooks(BooksSearchDto $filters): LengthAwarePaginator;
    public function createBook(BookCreateOrUpdateDto $dto): bool;
    public function getBookById(int $id): Book;
    public function updateBook(int $id, BookCreateOrUpdateDto $dto): bool;
    public function deleteBook(int $id): bool;
}