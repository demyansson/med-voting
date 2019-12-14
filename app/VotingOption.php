<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VotingOption extends Model
{
    protected $fillable = ['title', 'description'];

    /**
     * Get voting that owns voting option
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function voting()
    {
        return $this->belongsTo('App\Voting');
    }
}
