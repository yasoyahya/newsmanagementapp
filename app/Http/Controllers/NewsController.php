<?php

namespace App\Http\Controllers;

use App\Interfaces\NewsRepositoryInterfaces;
use Illuminate\Http\Request;
use App\Http\Requests\NewsRequest;
use App\Events\NewsEvent;
use App\Http\Resources\NewsResource;

class NewsController extends Controller
{
    protected $newsRepository;

    public function __construct(NewsRepositoryInterfaces $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function index()
    {
        $news = $this->newsRepository->all();
        return NewsResource::collection($news);
    }

    public function show($id)
    {
        $news = $this->newsRepository->find($id);

        if (!$news) {
            return response()->json(['error' => 'News not found'], 404);
        }

        return new NewsResource($news);
    }

    public function store(NewsRequest $request)
    {
        $data = $request->validated();
        $news = $this->newsRepository->create($data);

        return new NewsResource($news);
    }

    public function update(NewsRequest $request, $id)
    {
        $data = $request->validated();
        $news = $this->newsRepository->update($id, $data);

        if (!$news) {
            return response()->json(['error' => 'News not found'], 404);
        }

        return new NewsResource($news);
    }

    public function destroy($id)
    {
        $result = $this->newsRepository->delete($id);

        if (!$result) {
            return response()->json(['error' => 'Berita tidak ditemukan'], 404);
        }

        return response()->json(['message' => 'Berita dihapus'], 204);
    }
}
