<?php

namespace App\Http\Controllers;

use App\Services\VotingService;
use App\VotingOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class VoteController extends Controller
{
    private $votingService;

    /**
     * VoteController constructor.
     */
    public function __construct(VotingService $votingService)
    {
        $this->votingService = $votingService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (empty($request->input('voting_option_id'))) {
            throw new NotFoundHttpException();
        }

        $votingOption = VotingOption::with('voting')->findOrFail($request->input('voting_option_id'));

        Gate::authorize('vote-for-option', $votingOption->voting);

        $this->votingService->vote($votingOption, auth()->user());

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
