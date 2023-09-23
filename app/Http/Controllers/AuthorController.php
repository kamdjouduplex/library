<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'dob' => 'sometimes'
        ]);


        Author::create($data);
    }
}
