<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VulnerableController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    // 1. Injection SQL
    public function vulnerableSearch(Request $request)
    {
        $username = $request->input('username');
        $users = DB::select("SELECT * FROM users WHERE name LIKE '%$username%'");
        return view('search_results', ['users' => $users]);
    }

    // 2. XSS (Cross-Site Scripting)
    public function vulnerableComment(Request $request)
    {
        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->save();
        return redirect('/comments')->with('status', 'Commentaire ajouté!');
    }

    // 3. CSRF (Cross-Site Request Forgery)
    public function vulnerableUpdate(Request $request)
    {
        $user = User::find($request->input('id'));
        $user->name = $request->input('name');
        $user->save();
        return redirect('/profile')->with('status', 'Profil mis à jour!');
    }

    // 4. Authentification et gestion des sessions vulnérables
    public function vulnerableLogin(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Cet utilisateur n\'existe pas.']);
        }
        if ($user->password === $request->input('password')) {
            // Login successful
            session(['user_id' => $user->id]);
            return redirect('/profile')->with('status', 'Connecté avec succès!');
        }
        return back()->withErrors(['password' => 'Mot de passe incorrect.']);
    }

    // 5. Validation des entrées utilisateur manquante
    public function createPost(Request $request)
    {
        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();
        return redirect('/posts')->with('status', 'Post créé!');
    }

    // 6. Stockage non sécurisé des données sensibles
    public function addCreditCard(Request $request)
    {
        $user = User::find(session('user_id'));
        $user->credit_card = $request->input('credit_card');
        $user->save();
        return redirect('/profile')->with('status', 'Carte de crédit ajoutée!');
    }

    // 7. Gestion des accès et permissions manquante
    public function deletePost(Request $request, $id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect('/posts')->with('status', 'Post supprimé!');
    }

    public function showComments()
    {
        $comments = Comment::all();
        return view('comments', ['comments' => $comments]);
    }

    public function showProfile()
    {
        $user = User::find(session('user_id'));
        return view('profile', ['user' => $user]);
    }
}
