<?php
namespace App;
trait VoteableTrait {
    public function votes()
    {
        return $this->morphToMany(User::class, 'votable');
    }

    public function downVotes()
    {
        return $this->votes()->wherePivot('vote',-1);
    }
    public function upVotes()
    {
        return $this->votes()->wherePivot('vote',1);
    }
}