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

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);

        // $news = $this->newsRepository->all();
        $news = $this->newsRepository->paginate($perPage);

        return NewsResource::collection($news);
        // return response()->json($news);
    }

    public function show($id)
    {
        $news = $this->newsRepository->find($id);

        if (!$news) {
            return response()->json(['error' => 'Berita tidak ditemukan'], 404);
        }

        return response()->json($news);
    }

    public function store(NewsRequest $request)
    {
        $data = $request->validated();
        $news = $this->newsRepository->create($data);

        event(new NewsEvent($news, 'create'));

        return response()->json($news, 201);
    }

    public function update(NewsRequest $request, $id)
    {
        $data = $request->validated();
        $news = $this->newsRepository->update($id, $data);

        if (!$news) {
            return response()->json(['error' => 'Berita tidak ditemukan'], 404);
        }

        event(new NewsEvent($news, 'update'));

        return response()->json($news);
    }

    public function destroy($id)
    {
        $result = $this->newsRepository->delete($id);

        if (!$result) {
            return response()->json(['error' => 'Berita tidak ditemukan'], 404);
        }

        event(new NewsEvent(null, 'delete'));
        
        return response()->json(['message' => 'Berita dihapus'], 204);
    }
}
