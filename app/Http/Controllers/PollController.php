<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoteRequest;
use App\Models\Poll;
use App\Models\Vote;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $user_id = Auth::id();
        $polls = Poll::with(['answers'])
            ->whereDoesntHave('votes', function($q) use ($user_id) {
                $q->where('user_id', $user_id);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('polls/index', compact('polls'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return RedirectResponse
     */
    public function vote(VoteRequest $request, $id)
    {
        $user_id = Auth::id();
        $votes = Vote::where('user_id', $user_id)
                    ->where('answer_id', $request['answer'])
                    ->first();
        if($votes == null) {
            // Race condition here
            sleep(2);
            // Sleep to make it easier to exploit
            $vote = Vote::create([
                'user_id' => $user_id,
                'answer_id' => $request['answer'],
            ]);

            return redirect()->back()->with('success', 'Thank you for your vote!');
        }
        else {
            return redirect()->back()->with('failure', 'You have already voted!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return JsonResponse
     */
    public function revokeVotes(VoteRequest $request)
    {
        $user_id = Auth::id();
        $votes = Vote::where('user_id', $user_id)
            ->get();

        $votes->map->delete();

        return response()->json([
            'completed' => 'true',
        ]);
    }
}
