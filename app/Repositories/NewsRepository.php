<?php

namespace App\Repositories;

use App\Models\News;

class NewsRepository
{
    protected $news;

    public function __construct(News $news)
    {
        $this->news = $news;
    }

    public function getAll()
    {
        return $this->news->all();
    }

    public function findById($id)
    {
        return $this->news->find($id);
    }

    public function create(array $data)
    {
        return $this->news->create($data);
    }

    public function update($id, array $data)
    {
        $news = $this->findById($id);
        $news->update($data);
        return $news;
    }

    public function delete($id)
    {
        $news = $this->findById($id);
        return $news->delete();
    }

    public function getLatestNews()
    {
        return $this->news->orderBy('published_date', 'desc')->get();
    }

    public function paginate($page, $perPage)
    {
        return $this->news->orderBy('published_date', 'desc')->paginate($perPage, ['*'], 'page', $page);
    }
}
