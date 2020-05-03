<?php

namespace App;

use App\User;
use App\Answer;
use App\Question;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected  $fillable = ['question_id','user_id','body','votes_count'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function boot()
    {
        parent::boot();
        static::created(function($answer){
        $answer->question->increment('answers_count');
        });
        static::deleted(function($answer){
            $answer->question->decrement('answers_count');
        });
    }
    
    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute()
    {
        return $this->isBest() ? 'vote-accepted' : '';
    }
    public function getIsBestAttribute()
    {
        return $this->isBest();
    }
    public function isBest()
    {
        return $this->id === $this->question->best_answer_id;
    }

    public function votes()
    {
        return $this->morphToMany(User::class, 'votable');
    }
    
}
