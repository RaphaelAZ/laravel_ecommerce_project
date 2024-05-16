<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class ContactManagementController extends Controller
{
    public function index()
    {
        return view('admin.contact.index', [
            "comments" => Comment::paginate(15),
        ]);
    }
}
