<?php

namespace App\Http\Controllers;

use App\Models\Api;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Session;

class ApiController extends Controller
{

    /**
     * GET method function to display news articles and highlights.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function displayNews(Request $request)
    {
        $response = $this->determineMethodHandler($request);
        $apiModel = new Api();
        $response['news'] = $apiModel->fetchNewsFromSource($response['sourceId'], $response['pageNumber']);
        $response['newsSources'] = $this->fetchAllNewsSources();
        $response['highlights'] = $apiModel->fetchNewsHighlightsFromSource($response['sourceId']);

        //response for news Api request
        if ( isset($request->source) ) {
            return view('news_highlights_partial', $response);
        }

        //response for news homepage load
        return view('index', $response);
    }



    /**
     * POST method function to display get more news articles.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function loadMoreNews(Request $request) 
    {
        $apiModel = new Api();
        $request->validate([
            'source' => 'required|string',
        ]);
        $split_input = explode(':', $request->source);
        $response['sourceId'] = trim($split_input[0]);
        $response['sourceName'] = trim($split_input[1]);
        $response['news'] = $apiModel->fetchNewsFromSource($response['sourceId'], $request->pageNumber);

        return view('news_partial', $response);
    }



    /**
     * POST method function to display singleNewsDetail.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function displaySingleNewsDetail(Request $request) {
        
        $commentSaved = "";

        $singleNews["imageUrl"] = $request->image;
        $singleNews["title"] = $request->title;
        $singleNews["publishedAt"] = $request->publishedAt;
        $singleNews["author"] = $request->author;
        $singleNews["description"] = $request->desc;
        $singleNews["url"] = $request->url;
        $singleNews["content"] = $request->content;
        $singleNews["sourceId"] = $request->sourceId;
        $singleNews["sourceName"] = $request->sourceName;

        //save data in session, for reference in get method
        Session::put('singleNews', $singleNews);

        /**
         * Save comment if comment form submitted
         */
        if( isset($request->saveComment) ) {
            //validate & sanitize inputs
            $request->validate([
                'comment' => 'required',
                'url' => 'required'
            ]);
            
            //save
            Message::create([
                'article_url' => $request->url,
                'comment' => $request->comment,
                'user_id' => auth()->user()->id
            ]);

            $commentSaved = "Comment posted successfully!";
        }

        //retrieve comments with url from DB
        $messages = Message::where('article_url', $request->url)->get();
        // dd($messages);
        // die();

        return view('single', [
            'messages' => $messages,
            'singleNewsDetail' => $singleNews,
            'message' => $commentSaved
        ]);
    }



    /**
     * GET Method function to display singleNewsDetail.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSingleNewsDetail() 
    {
        $singleNews = Session::get('singleNews');

        //singleNews article available in session, hence perform code below
        if ( isset($singleNews) ) {
            //retrieve comments with url from DB
            $messages = Message::where('article_url', $singleNews["url"])->get();

            return view('single', [
                'messages' => $messages,
                'singleNewsDetail' => $singleNews
            ]);
        }

        //singleNews article NOT available in session, hence just return to page
        return view('single');
    }


    
    /**
     * Checks if request is GET or POST and performs specific task based on the request method
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function determineMethodHandler($request)
    {
        if($request->isMethod('get')) {
            $response['sourceName'] = config('app.default_news_source');
            $response['sourceId'] = config('app.default_news_source_id');
            $response['pageNumber'] = 1;
        } else {
            $request->validate([
                'source' => 'required|string',
            ]);
            $split_input = explode(':', $request->source);
            $response['sourceId'] = trim($split_input[0]);
            $response['sourceName'] = trim($split_input[1]);
            $response['pageNumber'] = $request->pageNumber;
        }
        return $response;
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
