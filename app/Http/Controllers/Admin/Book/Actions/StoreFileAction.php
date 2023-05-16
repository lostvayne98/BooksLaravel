<?php

namespace App\Http\Controllers\Admin\Book\Actions;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoreFileAction implements ActionInterface
{
    private $book;

    public function __construct(Book $book = null)
    {
        $this->book = $book;
    }

    public function handle(object $request):array
    {
        if ($this->book != null) {
            Storage::delete($this->book->cover);
        }

        $data = $request->validated();
       if ($request->hasFile('cover')) {
           $file = $request->file('cover');
           $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
           $file->storeAs('public/covers', $filename);
           $data['cover'] = $filename;
       }

       return $data;

    }
}
