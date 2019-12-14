<?php


namespace App\Services;


use App\User;
use App\Vote;
use App\Voting;
use App\VotingOption;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;

class VotingService
{
    /**
     * Voting validator
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|min:1|max:255',
            'description' => 'nullable|max:5000',
            'options.*.title' => 'required|min:1|max:255'
        ]);
    }

    /**
     * Create voting
     *
     * @param mixed $user
     * @param array $data
     * @param array $options
     * @return Voting
     */
    public function make($user, array $data, array $options)
    {
        $voiting = new Voting([
            'title' => $data['title'],
            'description' => $data['description']
        ]);

        $voiting->user()->associate($user);

        $voiting->save();

        $voiting->options()->createMany($options);

        return $voiting;
    }

    /**
     * @param VotingOption $option
     * @param User $user
     */
    public function vote(VotingOption $option, User $user)
    {
        $vote = new Vote();

        $vote->user()->associate($user);

        $vote->option()->associate($option);

        $vote->save();
    }

    /**
     * @param $id
     * @return Builder|Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function find($id)
    {
        return $this->fullVotingQueryBuilder()->findOrFail($id);
    }

    /**
     * Get user voted option by voting
     *
     * @param Voting $voting
     * @param User $user
     * @return Builder|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\HasMany|object
     */
    public function getUserVotedVotingOption(Voting $voting, User $user)
    {
        return $voting->options()->whereHas('votes', function (Builder $q) use ($user) {
            $q->where('votes.user_id', $user->id);
        })->first();
    }

    /**
     * Get voting results
     *
     * @param Voting $voting
     * @return array
     */
    public function getVotingResult(Voting $voting, $hide = false)
    {
        $options = [];

        $totalVoted = $voting->votes_count;


        foreach ($voting->options as $option) {
            $options[] = [
                'id' => $option->id,
                'title' => $option->title,
                'description' => $option->description,
                'voted' => $hide ? null : $option->votes_count,
                'votedPercent' => $hide ? null : round($option->votes_count / ($totalVoted / 100), 2),
            ];
        }

        return [
            'hidden' => $hide,
            'total' => [
                'voted' => $totalVoted
            ],
            'options' => $options,
        ];
    }

    /**
     * Get voting query builder with all relations
     *
     * @return Builder
     */
    private function fullVotingQueryBuilder()
    {
        return Voting::with(['options' => function ($q) {
            $q->withCount('votes');
        }, 'votes'])->withCount('votes');
    }
}
