<?php

namespace App\Http\Controllers;

use App\Exceptions\ResponseConstructor;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use PD\Helpers\PaginatorHelper;


class PostsController extends Controller
{
    protected $paginator,$responseConstructor,$request;

    /**
     * @param PaginatorHelper $paginator
     * @param MessagePaginator $msgpage
     */
    public function __construct(Request $request ,PaginatorHelper $paginator,ResponseConstructor $responseConstructor){

        $this->request = $request;
        $this->paginator = $paginator;
        $this->responseConstructor = $responseConstructor;
        $this->middleware('jwt.auth');
    }

    public function fetchPosts(){
        $newCursor = null;
        try{
            $pageLimit = $this->request->get('pageLimit');

            $pageNo = $this->request->get('page');

            $categoryIds = $this->request->input('categoryId');

            $prevCursor = $this->request->input('prevCursor');

            $nextCursor = $this->request->input('nextCursor');

           // dd($categoryIds);
            //s $variable = explode(",", $categoryIds);
            $decodedPrevCursor = base64_decode($prevCursor);
            $decodedNextCursor = base64_decode($nextCursor);

          //  var_dump($decodedPrevCursor,$decodedNextCursor);

            if ($decodedNextCursor) {
                $posts = Post::where('created_at', '<', $decodedNextCursor)
                    ->whereIn('categoryId', $categoryIds)
                    ->orderBy('created_at','desc')
                    ->take($pageLimit)
                    ->get();
                //dd($posts);
            } else if($decodedPrevCursor){
                $posts = Post::where('created_at', '>', $decodedPrevCursor)
                    ->whereIn('categoryId', $categoryIds)
                    ->orderBy('created_at','desc')
                    ->take($pageLimit)
                    ->get();}
            else {
                $posts =Post::whereIn('categoryId', $categoryIds)
                    ->orderBy('created_at','desc')
                    ->take($pageLimit)
                    ->get();

                //  Post::whereIn('categoryId', $categoryIds)->get();
            }
            //dd($posts->count());
            //dd($cursor,$posts);
            if($posts->count() > 0)
            {
                $newCursor = $posts->last()->created_at;

                $newCursor = base64_encode($newCursor);
                //dd($newCursor);
            }
            $totalPosts = Post::whereIn('categoryId', $categoryIds)
                ->orderBy('created_at','desc')->get();
            //dd($posts->appends(["cursor"=>$cursor])->previousPageUrl());
            //dd($posts->appends(["cursor"=>$newCursor])->nextPageUrl());



            $lengthpage  = new Paginator($totalPosts,$pageLimit,$pageNo);
            $lengthpage1  = new Paginator($totalPosts,$pageLimit,$pageNo);

            // dd($lengthpage->items());
            // $lengthpage->appends(["cursor"=>$newCursor]);
            //  var_dump($posts);
            // var_dump($newCursor);
            //$cursor = new Cursor( $previousCursor, $newCursor, $posts->count());
            //dd($lengthpage->items());
            $resource = collect();
            //dd(collect($resource));
            // $resource->setCursor($cursor);
            $resource=$resource->merge(["items"=>$posts]);
            $merged = $resource->merge(["totalCount" => $totalPosts->count()]);
            $merged = $merged->merge(["currentPage" => $lengthpage->currentPage()]);
            $merged = $merged->merge(["hasMorePages" => $lengthpage->hasMorePages()]);
            $merged = $merged->merge(["prevUrl" => $lengthpage1->appends(["prevCursor"=>$nextCursor])->previousPageUrl()]);
            $merged = $merged->merge(["nextUrl" => $lengthpage->appends(["nextCursor"=>$newCursor])->nextPageUrl()]);

            /*$posts = Post::whereIn('categoryId', $categoryIds)

				->orderBy('publishedDate','desc')
				->paginate($pageLimit);*/
            //dd($merged);
            return response()->json($merged->all());

        }catch (Exception $e){

            throw new Exception("Post retrievel error");

        }

    }

    /**
     * Generic method for returning pag`inated results
     * @param $items
     * @return mixed
     */
    private function paginateResults($items,$pageLimit,$pageNumber){

        $page =  $pageNumber;

        $perPage = $pageLimit;

        $lengthpage  = new LengthAwarePaginator($items->forPage($page, $perPage),$items->count(), $perPage, $page);
        //$this->msgPage->offsetSet('next',$messages);
        return $this->paginator->respondWithPagination($lengthpage);
    }
}
