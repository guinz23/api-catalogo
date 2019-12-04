<?php

namespace App\Http\Controllers;

use App\Collection;
use App\Http\Controllers\BaseController as BaseController;
use App\Http\Resources\Collection as CollectionResource;
use App\Services\CollectionService;
use Illuminate\Http\Request;
use Validator;

class CollectionController extends BaseController
{
    public $collectionService;

    public function __construct(CollectionService $collectionService)
    {
        $this->collectionService = $collectionService;
    }
    public function index()
    {
        return $this->sendResponse(CollectionResource::collection($this->collectionService->getAll()), 'Colletions retrieved successfully.');
    }

    public function store(Request $request)
    {
        if (Self::ValidateRequest($request)->fails()) {
            return $this->sendError('Validation Error.', Self::ValidateRequest($request)->errors());
        }
        return $this->sendResponse(new CollectionResource($this->collectionService->create($request)), 'Colletions created successfully.');
    }

    public function show($id)
    {
        if (is_null($this->collectionService->findById($id))) {
            return $this->sendError('Product not found.');
        }
        return $this->sendResponse(new CollectionResource($this->collectionService->findById($id)), 'Colletions retrieved successfully.');
    }
    public function update(Request $request,$id)
    {
        if (Self::ValidateRequest($request)->fails()) {
            return $this->sendError('Validation Error.', Self::ValidateRequest($request)->errors());
        }
        return $this->sendResponse(new CollectionResource($this->collectionService->update($request,$id)), 'Colletions updated successfully.');
    }
    public function destroy(Collection $collection)
    {
        $this->collectionService->delete($collection);
        return $this->sendResponse([], 'Colletions deleted successfully.');
    }
    private function ValidateRequest($request)
    {
        $validator = Validator::Make($request->all(), [
            'name' => 'required',
        ]);
        return $validator;
    }
}
