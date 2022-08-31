<?php

namespace App\Http\Controllers;

use App\Models\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    
    /**
     * Retreive and display news articles and highlights for the homepage.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $response['sourceName'] = config('app.default_news_source');
        $response['sourceId'] = config('app.default_news_source_id');
        $apiModel = new Api();
        $response['news'] = $apiModel->fetchNewsFromSource($response['sourceId']);
        $response['newsSources'] = $this->fetchAllNewsSources();
        return view('index', $response);
    }



    /**
     * Intitiate request to retrieve all news articles
     */
    public function fetchAllNewsSources()
    {
        $response = Cache::remember('allNewsSources', 22 * 60, function() {
            $api = new Api;
            return $api->getAllSources();
        });
        return $response;
    }
}
