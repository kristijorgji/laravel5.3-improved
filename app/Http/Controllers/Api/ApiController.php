<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ApiController extends Controller
{

    protected $statusCode = 200;

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @param string $message
     */
    public function responseNotFound($message = "Not found!")
    {
        return $this->setStatusCode(404)->respondWithError($message);
    }

    /**
     * @param $data
     * @param array $headers
     * @return mixed
     */
    public function respond($data, $headers = [])
    {
        return response()->json($data, $this->getStatusCode(), $headers);
        //return \Response::json($data, $this->getStatusCode(), $headers);
    }

    /**
     * @param $message
     * @return mixed
     */
    public function respondWithError($message, $ecode = null)
    {
        return $this->respond([
            'error' => [
                [
                    'message' => $message,
                    'status_code' => $this->getStatusCode(),
                    'error_code' => $ecode
                ]
            ]
        ]);
    }

    protected function respondWithPagination(LengthAwarePaginator $items, $data)
    {
        $data = array_merge($data, [
            'total_count' => $items->total(),
            'total_pages' => $items->lastPage(),
            'current_page' => $items->currentPage(),
            'limit' => $items->perPage(),
        ]);
        return $this->respond($data);
    }


}
