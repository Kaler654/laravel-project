<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Mail\ArticleMail;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    
        $articles = Article::latest()->paginate(5);
        return view('articles/index', ['articles'=>$articles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', [self::class]);
        return view('articles/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'datePublic'=>'required',
            'title'=>'required',
            'desc'=>'required'
        ]);

        $article = new Article;
        $article->datePublic = $request->datePublic;
        $article->title = $request->title;
        $article->desc = $request->desc;
        $article->shortDesc = $request->shortDesc;
        $result = $article->save();
        if ($result) Mail::send(new ArticleMail($article));
        return redirect(route('articles.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $comments = Comment::where('article_id',$article->id)->get();
        return view('articles/show', ['article'=>$article, 'comments'=>$comments]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('articles/edit', ['article'=>$article]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'datePublic'=>'required',
            'title'=>'required',
            'desc'=>'required'
        ]);

        $article->datePublic = $request->datePublic;
        $article->title = $request->title;
        $article->desc = $request->desc;
        $article->shortDesc = $request->shortDesc;
        $article->save();
        return redirect(route('articles.show', ['article'=>$article->id]));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {

        $article->comments()->delete();
        $article->delete();
        return redirect()->route('articles.index');
    }
}
