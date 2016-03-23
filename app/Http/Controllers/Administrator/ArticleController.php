<?php

namespace App\Http\Controllers\Administrator;

use App\Models\Article;
use App\Models\ArticleType;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.article.index')->with([
            'items' => Article::paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.article.create')->with([
            'types' => ArticleType::all()
        ]);
    }

    public function delete($id)
    {
        //TODO
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $article = Article::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'uri' => $request->input('uri'),
            'type_id' => $request->input('article_type')
        ]);

        $thumbnail = $request->file('thumbnail');
        $file_name = $article->id . '.' . $thumbnail->getClientOriginalExtension();
        $path = 'image/thumbnail/' . $file_name;
        $thumbnail->move(public_path('image/thumbnail'), $file_name);
        $article->update([
            'thumbnail' => url($path)
        ]);

        return redirect('article')->with([
            'success' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
