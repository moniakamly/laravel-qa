<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Question; 
use App\Answer; 

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * adding the accesors as appends so that they will be included when using vue js 
     */
    
    protected $appends = ['url', 'avatar'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function questions() {
        return $this->hasMany(Question::class);
    }

    public function getUrlAttribute() {
        // return route("questions.show", $this->id);
        return '#' ; 
    }

    public function answers() {
        return $this->hasMany(Answer::class);
    }

    public function getAvatarAttribute() {
        $email = $this->email;
        $size = 32;

         return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?s=" . $size;
    }

    //a User can favorite more than one question 
    // we need to specify the name of the table in the second argument or else we'll have an error 
    public function favorites() {
        return $this->belongsToMany(Question::class, 'favorites')->withTimestamps(); //, 'user_id', 'question_id'); 
    }

    // A user can vote for either a question or an answer 

    public function voteQuestions() {

        return $this->morphedByMany(Question::class, 'votable'); 
    }

    public function voteAnswers() {

        return $this->morphedByMany(Answer::class, 'votable'); 
    }

    public function voteQuestion(Question $question , $vote) {
        
        $voteQuestions = $this->voteQuestions(); 
        $this->_vote($voteQuestions, $question, $vote); 
        
    }


    public function voteAnswer(Answer $answer, $vote) {

        $voteAnswers = $this->voteAnswers(); 
        $this->_vote($voteAnswers, $answer, $vote); 
        
    }

    private function _vote($relationship, $model, $vote) {

        if ($relationship->where('votable_id', $model->id)->exists()) {
            $relationship->updateExistingPivot($model, ['vote' => $vote]);
        }
        else {
            $relationship->attach($model, ['vote' => $vote]); 
        }

        $model->load('votes'); 
        $downVotes = (int) $model->downVotes()->sum('vote'); // we use sum instead of count because count will return a positive number which is
        // the total number of vote while sum will sum the votes and return both negative and positive number 
        $upVotes = (int) $model->upVotes()->sum('vote'); 
        $model->votes_count = $upVotes + $downVotes; 
        $model->save(); 
    }

}
