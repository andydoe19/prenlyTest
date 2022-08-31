<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Api extends Model
{
    use HasFactory;


    /**
     * Fetches all news articles from the news api
     */
    public function fetchNewsFromSource($newsSource, $pageNumber) 
    {
        $urlParams = 'everything?sources=' . $newsSource . '&language=en&pageSize=10&page=' . $pageNumber;
        $response = (new Helper)->makeApiCalls($urlParams);
        return Arr::get($response, 'articles');
    }


    /**
     * Fetches top news highlights from news api
     */
    public function fetchNewsHighlightsFromSource($newsSource) 
    {
        $urlParams = 'top-headlines?sources=' . $newsSource;
        $response = (new Helper)->makeApiCalls($urlParams);
        return Arr::get($response, 'articles');
    }


    /**
     * Fetches all valid news sources from news api
     */
    public function getAllSources() 
    {
        $urlParams = 'sources?';
        $response = (new Helper)->makeApiCalls($urlParams);
        return Arr::get($response, 'sources');
    }
}
