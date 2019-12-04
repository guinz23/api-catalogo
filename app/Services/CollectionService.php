<?php

namespace App\Services;

use App\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollectionService
{

    public function getAll()
    {
        return Collection::all();
    }
    public function create(Request $request)
    {
      $collection = new Collection;
      $collection->name = $request->input('name');
      $collection->user_id = Auth::user()->id;
      $collection->save();
       return $collection;
    }
      public function findById($id){
          return Collection::find($id);
      }
    public function update(Request $request, $id)
    {
      $collection = Collection::find($id);
      $collection->name = $request->input('name');
      $collection->save();
       return $collection;
    }
    public function delete($collection)
    {
      $collection_delete=Collection::find($collection);
      $collection->delete();
    }
}
