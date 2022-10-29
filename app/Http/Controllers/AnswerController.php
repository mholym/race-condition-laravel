<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $polls = Poll::with(['answers'])
            ->withCount('votes')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('polls/answers', compact('polls'));
    }
}
