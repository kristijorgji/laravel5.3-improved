<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        //we need to see that json back if we access the route correctly
        echo "DADADADADADA";
        return [
            [
                "id" => 1,
                "name" => "k"
            ],
            [
                "id" => 2,
                "name" => "j"
            ]
        ];
    }
}
