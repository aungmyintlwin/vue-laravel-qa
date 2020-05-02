<?php

namespace App;

use App\User;
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
        $answer->question->save();
        });
    }
    
    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}
