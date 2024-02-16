<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;

/**
 * removes directory at $src destination
 */
function removeDir($src) {
    $dir = opendir($src);
    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            $full = $src . '/' . $file;
            
            if ( is_dir($full) ) {
            removeDir($full);
            }
            else {
                unlink($full);
            }
        }
    }
    closedir($dir);
    rmdir($src);
}

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Articles/Index', [
            'articles' => Article::with('user:id,name')->where('user_id', Auth::id())->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Articles/New', [
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            // 'imageFile' => 'required|image|mimetypes:image/*|max:2048',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string|max:255',
            'cover' => 'required|string|max:255',
        ]);

        $article = $request->user()->articles()->create($validated);
        
        if ($request->hasFile('imageFile')) {
            $file = $request->file('imageFile');
            
            if( !preg_match('/^image\/.{0,4}$/',$file->getMimeType()) ) {
                return redirect( route('error403') );
            }

            // not sure if I need to validate again this value
            // $file->getSize();

            // Create a dir specific for this article
            $destinationPath = public_path()."/resources/articles/".$article->id."/";

            mkdir($destinationPath,0744);

            $file->move($destinationPath,$file->getClientOriginalName());
        }

        return redirect(route('articles.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return Inertia::render('Articles/Show', [
            'article' => $article,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return Inertia::render('Articles/Edit', [
            'article' => $article
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article): RedirectResponse
    {
        $this->authorize('update', $article);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string|max:255',
            'cover' => 'required|string|max:255',
        ]);
        
        $article->update($validator->validated());
        
        return redirect(route('articles.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article): RedirectResponse
    {
        $this->authorize('delete',$article);

        $articleDirPath = public_path()."/resources/articles/".$article->id."/";
        removeDir($articleDirPath);
        
        $article->delete();
        
        return redirect(route('articles.index'));
    }
}
