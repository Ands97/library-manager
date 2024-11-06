<?php
namespace App\Services;

use App\Dtos\BookCreateOrUpdateDto;
use App\Dtos\BooksSearchDto;
use App\Interfaces\BookService;
use App\Models\Book;
use Illuminate\Pagination\LengthAwarePaginator;

class BookServiceImpl implements BookService
{
    public function getAllBooks(BooksSearchDto $filters): LengthAwarePaginator
    {
        $query = Book::query();

        if ($filters->getSearch()) {
            $query->bySearch($filters->getSearch());
        }

        if ($filters->getPublicationYear()) {
            $query->byPublicationYear($filters->getPublicationYear());
        }

        $books = $query
            ->orderBy('created_at', 'desc')
            ->paginate($filters->getLimit());

        return $books;
    }

    public function createBook(BookCreateOrUpdateDto $dto): bool
    {
        $book = new Book();
        $book->fill($dto->toArray());
        $book->saveOrFail();
        
        return true;
    }  

    public function getBookById(int $id): Book
    {
        return Book::findOrFail($id);
    }

    public function updateBook(int $id, BookCreateOrUpdateDto $dto): bool
    {
        $book = $this->getBookById($id);
        $book->fill($dto->toArray());
        $book->saveOrFail();

        return true;
    }

    public function deleteBook(int $id): bool
    {
        $book = $this->getBookById($id);
        $book->delete();

        return true;
    }
}