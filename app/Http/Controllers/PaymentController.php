<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Post;
use Storage;

class PaymentController extends Controller
{
    public function index(Lesson $lesson)
    {
        return view('payment');
    }
}
