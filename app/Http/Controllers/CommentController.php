<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;

class CommentController extends Controller
{
    public function index() {
        return view('contact');
    }

    public function add(Request $request): RedirectResponse
    {
        try {
            //Si la req n'est pas POST
            throw_if(!$request->isMethod('POST'));

            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'message' => 'required|string',
            ]);
            $comment = new Comment();
        
            $comment->name = $request->input('name');
            $comment->email = $request->input('email');
            $comment->comment = $request->input('message');
        
            $comment->save();
        } catch (Exception|Throwable $e) {} 
        finally {
            return redirect()->back()->with('throwBack','Votre demande de contact a bien été prise en compte.');
        }
    }
}
