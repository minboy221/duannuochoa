<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the news articles.
     */
    public function index()
    {
        $articles = Article::published()
            ->with('author')
            ->latest()
            ->paginate(6);

        return view('clien.news.index', compact('articles'));
    }

    /**
     * Display the specified news article.
     */
    public function show($slug)
    {
        $article = Article::where('slug', $slug)
            ->published()
            ->with('author')
            ->firstOrFail();

        // Fetch recent news for the sidebar (excluding current)
        $recentNews = Article::published()
            ->where('article_id', '!=', $article->article_id)
            ->latest()
            ->take(5)
            ->get();

        return view('clien.news.show', compact('article', 'recentNews'));
    }
}
