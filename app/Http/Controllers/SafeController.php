<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SafeController extends Controller
{
    // 1. Protection contre l'injection SQL
    public function safeSearch(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'username' => 'nullable|string|max:255',
            'order' => 'nullable|in:name,email',
            'limit' => 'nullable|integer|min:1|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $username = $request->input('username');
        $order = $request->input('order', 'name');
        $limit = $request->input('limit', 10);

        $users = DB::table('users')
            ->when($username, function ($query) use ($username) {
                return $query->where('name', 'LIKE', '%' . $username . '%');
            })
            ->orderBy($order)
            ->limit($limit)
            ->get();

        return view('search', ['users' => $users]);
    }

    public function safeLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
        ]);
    }

    public function safeCreatePost(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post = Post::create($validatedData);
        return redirect('/posts')->with('status', 'Post créé!');
    }

    public function safeAddCreditCard(Request $request)
    {
        $user = User::find(session('user_id'));
        $user->credit_card = Crypt::encrypt($request->input('credit_card'));
        $user->save();
        return redirect('/profile')->with('status', 'Carte de crédit ajoutée en toute sécurité!');
    }

    public function safeDeletePost(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        if ($request->user()->cannot('delete', $post)) {
            abort(403);
        }
        $post->delete();
        return redirect('/posts')->with('status', 'Post supprimé!');
    }
}
