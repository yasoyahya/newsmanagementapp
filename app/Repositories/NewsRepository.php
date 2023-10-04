<?php

namespace App\Repositories;

use App\Interfaces\NewsRepositoryInterfaces;
use App\Models\News;
use Illuminate\Support\Facades\DB;


class NewsRepository implements NewsRepositoryInterfaces
{
    public function all()
    {
        return News::all();
    }

    public function find($id)
    {
        return News::find($id);
    }

    public function create(array $data)
    {
        return News::create($data);
    }

    public function update($id, array $data)
    {
        $news = News::find($id);
        if ($news) {
            $news->update($data);
            return $news;
        }
        return null;
    }

    public function delete($id)
    {
        $news = News::find($id);
        if ($news) {
            $news->delete();
            return true;
        }
        return false;
    }

    public function paginate($perPage)
    {
        return DB::table('news')->paginate($perPage);
    }
}
