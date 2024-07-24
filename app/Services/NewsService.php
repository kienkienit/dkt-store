<?php

namespace App\Services;

use App\Repositories\NewsRepository;

class NewsService
{
    protected $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function getAllNews()
    {
        return $this->newsRepository->getAll();
    }

    public function getNewsById($id)
    {
        return $this->newsRepository->findById($id);
    }

    public function createNews($data)
    {
        return $this->newsRepository->create($data);
    }

    public function updateNews($id, $data)
    {
        return $this->newsRepository->update($id, $data);
    }

    public function deleteNews($id)
    {
        return $this->newsRepository->delete($id);
    }

    public function getLatestNews()
    {
        return $this->newsRepository->getLatestNews();
    }

    public function paginateNews($page)
    {
        return $this->newsRepository->paginate($page);
    }
}
