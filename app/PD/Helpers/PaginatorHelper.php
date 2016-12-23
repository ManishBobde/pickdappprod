<?php
/**
 * Created by PhpStorm.
 * User: Hash
 * Date: 20-08-2015
 * Time: 23:45
 */

namespace PD\Helpers;


use Illuminate\Pagination\LengthAwarePaginator;

class PaginatorHelper {


    /**
     * @param Paginator $page
     * @param $data
     * @return mixed
     */
    public function respondWithPagination(LengthAwarePaginator $page){



        $data =  array(
            'items'=>$page->items(),
            'totalCount'=>$page->total(),
            'totalPages' => ceil($page->total()/$page->perPage()),
            'currentPage' => $page->currentPage(),
            'limit' => $page->perPage()
            );
        return $this->respond($data);

    }

    public function respond($data)
    {
        return response()->json($data);
    }

}