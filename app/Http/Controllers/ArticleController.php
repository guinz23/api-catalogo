<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\BaseController as BaseController;
use App\Http\Resources\Article as ArticleResource;
use Illuminate\Support\Facades\Auth;

class ArticleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();
         $name= Auth::user()->token()->id;
        return $this->sendResponse(ArticleResource::collection($articles), 'Products retrieved successfully'.$name);
    }

    public function store(Request $request)
    {
        print_r($request->header());
        $input=$request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $article = Article::create($input);
   
        return $this->sendResponse(new ArticleResource($article), 'Product created successfully.');
    

    }
    public function show(Article $article)
    {
        
    }
    public function update(Request $request, Article $article)
    {
        //
    }
    public function destroy(Article $article)
    {
        //
    }
}
