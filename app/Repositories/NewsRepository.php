<?php

namespace App\Repositories;

use App\Models\News;

class NewsRepository extends BaseRepository
{
    const PER_PAGE = 5;

    public function __construct(News $news)
    {
        parent::__construct($news);
    }

    public function getLatestNews()
    {
        return $this->model->orderBy('published_date', 'desc')->get();
    }

    public function paginate($page, $perPage = self::PER_PAGE)
    {
        return $this->model->orderBy('published_date', 'desc')->paginate($perPage, ['*'], 'page', $page);
    }
}
