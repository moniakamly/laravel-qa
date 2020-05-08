<?php 
namespace App; 

trait VotableTrait 
{
    // A user can vote for one or many answers  or for one or many questions
    public function votes() {
        return $this->morphToMAny(User::class, 'votable'); 
    }

    public function upVotes() {
        return $this->votes()->wherePivot('vote', 1); 
    }

    public function downVotes() {
        return $this->votes()->wherePivot('vote', -1); 
    }
}