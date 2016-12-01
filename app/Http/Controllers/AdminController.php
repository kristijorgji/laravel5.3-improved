<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
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
