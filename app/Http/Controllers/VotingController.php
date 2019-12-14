<?php

namespace App\Http\Controllers;

use App\Services\VotingService;
use App\Voting;
use Illuminate\Http\Request;

class VotingController extends Controller
{
    /**
     * @var VotingService
     */
    private $votingService;

    public function __construct(VotingService $votingService)
    {
        $this->votingService = $votingService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('voting.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->votingService->validator($request->all())->validate();

        $voting = $this->votingService->make(auth()->user(), $request->all(), $request->input('options'));

        if (!$voting->id) {
            abort(500);
        }

        return redirect()->route('voting.edit', ['voting' => $voting->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Voting $voting
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $voting = $this->votingService->find($id);

        $votedOption = $this->votingService->getUserVotedVotingOption($voting, auth()->user());

        $votingResult = $this->votingService->getVotingResult($voting, !$votedOption);

        return view('voting.show', compact('voting', 'votedOption', 'votingResult'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Voting $voting
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $voting = Voting::with('options')->findOrFail($id);

        return view('voting.edit', compact('voting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Voting $voting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Voting $voting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Voting $voting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voting $voting)
    {
        //
    }
}
