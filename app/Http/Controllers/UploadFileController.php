<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Models\Article;

class UploadFileController extends Controller
{
    
    /**
     * Upload an article's cover image
     */
    public function store(Request $request, $articleID)
    {
        $article = Article::findOrFail($articleID);

        $this->authorize('update', $article);
        
        if ($request->hasFile('coverFile')) {
            $file = $request->file('coverFile');
            
            if( !preg_match('/^image\/.{0,4}$/',$file->getMimeType()) ) {
                return redirect( route('error403') );
            }
            
            $previousCover = public_path()."/resources/articles/".$article->id."/".$article->cover;

            if(File::exists($previousCover)) {
                File::delete($previousCover);
            }

            // Create a dir specific for this article
            $destinationPath = public_path()."/resources/articles/".$article->id."/";

            $file->move($destinationPath,$file->getClientOriginalName());
            $article->cover = $file->getClientOriginalName();

            $article->update(['cover']);
        }
    }

}
