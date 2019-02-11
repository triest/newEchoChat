<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;

class ContactsController extends Controller {
    //
    public function get() {
        // get all users except the authenticated one
        $contacts = User::where('id', '!=', auth()->id())->get();
        return response()->json($contacts);
    }

    public function getMessagesFor($id) {
        // mark all messages with the selected contact as read
        $messages = Message::where('from', $id)->orWhere('to', $id)->get();
        //  $messages = Message::where('from', $id)->where('to', auth()->id());
        // get all messages between the authenticated user and the selected user
        /*  $messages = Message::where(function ($q) use ($id) {
              $q->where('from', auth()->id());
              $q->where('to', $id);
          })->orWhere(function ($q) use ($id) {
              $q->where('from', $id);
              $q->where('to', auth()->id());
          })
                  ->get();*/
        return response()->json($messages);
    }

    public function send(Request $request) {
        $message = Message::create([
                'from' => auth()->id(),
                'to' => $request->contact_id,
                'text' => $request->text
        ]);
        broadcast(new NewMessage($message));
        return response()->json($message);
    }
}
