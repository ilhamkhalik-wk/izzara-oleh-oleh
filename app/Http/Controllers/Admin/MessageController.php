<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactMessage;

class MessageController extends Controller
{
    /**
     * Display contact messages
     */
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(10);
        return view('admin.messages.index', compact('messages'));
    }

    /**
     * Mark message as read/unread
     */
    public function toggleRead(ContactMessage $message)
    {
        $message->is_read = !$message->is_read;
        $message->save();

        return back()->with('success', 'Status pesan diperbarui!');
    }

    /**
     * Delete message
     */
    public function destroy(ContactMessage $message)
    {
        $message->delete();
        return back()->with('success', 'Pesan berhasil dihapus!');
    }
}
