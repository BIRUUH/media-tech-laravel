<?php
namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function create()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|max:100',
            'number' => 'required|max:12',
            'message' => 'required|max:500'
        ]);

        Message::create([
            'user_id' => Auth::id() ?? 0,
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'message' => $request->message
        ]);

        return redirect()->back()->with('success', 'Pesan berhasil dikirim');
    }
}