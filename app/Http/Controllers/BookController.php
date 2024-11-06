<?php

namespace App\Http\Controllers;

use App\Dtos\BookCreateOrUpdateDto;
use App\Dtos\BooksSearchDto;
use App\Interfaces\BookService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    private BookService $bookService;

    public function __construct(BookService $bookService)
    {
        $this->middleware('auth');
        $this->bookService = $bookService;
    }

    public function index(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'search' => 'nullable|string',
                'publication_year' => 'nullable|integer',
                'page' => 'nullable|integer',
                'limit' => 'nullable|integer',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $dataSearch = new BooksSearchDto($request->all());
            
            $books = $this->bookService->getAllBooks($dataSearch);

            return view('books.index', compact('books'));
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('Ocorreu um erro!')->withInput();

        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string',
                'author' => 'required|string',
                'description' => 'nullable|string',
                'publication_year' => 'required|integer|digits:4|min:1900|max:' . date('Y'),
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $bookDto = new BookCreateOrUpdateDto(
                $request->get('title'),
                $request->get('author'),
                $request->get('description'),
                $request->get('publication_year')
            );

            $this->bookService->createBook($bookDto);

            return redirect()->route('books.index')->with('success', 'Livro inserido com sucesso!');
        } catch (\Throwable $th) {
            Log::error("Error to create book", [
                'error' => $th->getMessage()
            ]);
            return redirect()->back()->withErrors('Ocorreu um erro')->withInput();
        }
    }

    public function create()
    {
        return view('books.create');
    }

    public function edit($id)
    {
        try {
            $book = $this->bookService->getBookById($id);

            return view('books.edit', compact('book'));
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('Ocorreu um erro')->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string',
                'author' => 'required|string',
                'description' => 'nullable|string',
                'publication_year' => 'required|integer|digits:4|min:1900|max:' . date('Y'),
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $bookDto = new BookCreateOrUpdateDto(
                $request->get('title'),
                $request->get('author'),
                $request->get('description'),
                $request->get('publication_year')
            );

            $this->bookService->updateBook($id, $bookDto);

            return redirect()->route('books.index')->with('success', 'Livro atualizado com sucesso!');
        } catch (\Throwable $th) {
            Log::error("Error to update book", [
                'error' => $th->getMessage()
            ]);
            return redirect()->back()->withErrors('Ocorreu um erro')->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $this->bookService->deleteBook($id);

            return redirect()->route('books.index')->with('success', 'Livro removido com sucesso!');
        } catch (\Throwable $th) {
            Log::error("Error to delete book", [
                'error' => $th->getMessage()
            ]);
            return redirect()->back()->withErrors('Ocorreu um erro')->withInput();
        }
    }
}
