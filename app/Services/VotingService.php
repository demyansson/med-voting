<?php


namespace App\Services;


use App\Voting;
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
}
