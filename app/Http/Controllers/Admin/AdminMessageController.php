<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;

class AdminMessageController extends Controller
{
    public function index()
    {
        $messages = Message::with('user')->latest()->paginate(15);
        return view('admin.messages.index', compact('messages'));
    }

    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.messages.index')
                        ->with('success', 'Pesan berhasil dihapus');
    }
}