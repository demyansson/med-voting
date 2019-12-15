<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voting extends Model
{
    protected $fillable = ['title', 'description'];

    /**
     * @var array
     *
     * Voting result
     */
    private $result;

    /**
     * Get the user that owns the voting
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get options that belongs to the voting
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function options()
    {
        return $this->hasMany('App\VotingOption');
    }

    /**
     * Get all votes for the voting
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function votes()
    {
        return $this->hasManyThrough('App\Vote', 'App\VotingOption');
    }

    /**
     * Get result
     *
     * @return array
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set result
     *
     * @param array $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }
}
