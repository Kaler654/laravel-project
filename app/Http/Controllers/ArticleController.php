<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Mail\ArticleMail;

use App\Jobs\VeryLongJob;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    
        $articles = Article::latest()->paginate(5);
        // return view('articles/index', ['articles'=>$articles]);
        return response()->json($articles, 201);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', [self::class]);
        // return view('articles/create');
        return response()->json($article, 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'datePublic'=>'required',
            'title'=>'required',
            'desc'=>'required',
            'shortDesc'=>'required',
        ]);

        $article = new Article;
        $article->datePublic = $request->datePublic;
        $article->title = $request->title;
        $article->desc = $request->desc;
        $article->shortDesc = $request->shortDesc;
        $result = $article->save();
        if ($result) VeryLongJob::dispatch($article);
        // return redirect(route('articles.index'));
        return response()->json($result, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $comments = Comment::where('article_id',$article->id)->get();
        // return view('articles/show', ['article'=>$article, 'comments'=>$comments]);
        return response()->json($article, 201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        // return view('articles/edit', ['article'=>$article]);
        return response()->json($article, 201);
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
        $result = $article->save();
        // return redirect(route('articles.show', ['article'=>$article->id]));
        return response()->json($result, 201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {

        $article->comments()->delete();
        
        // return redirect()->route('articles.index');
        return response()->json($article->delete(), 201);
    }
}
