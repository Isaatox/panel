<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class QCM extends Model
{
    public $table = "qcm";

    use HasFactory;

    public function questions()
    {
        $ids = collect(DB::table("qcm_questions")->select('question_id')->where('cqm_id', $this->id)->get())->map(function($el){
            return $el->question_id;
        })->values()->toArray();

        return DB::table("questions")->whereIn('id', $ids)->get();
    }


    public function user()
    {
        return DB::table("users")->find($this->user_id);
    }



    public function diff()
    {
        if ($this->end_at == null){
            return 'En attente';
        }
        $timestamp1 = (new \DateTime($this->end_at))->getTimestamp();
        $timestamp2 = (new \DateTime($this->created_at))->getTimestamp();
        $seconds = $timestamp1 - $timestamp2;
        $hours = floor($seconds / 3600);
        $mins = floor($seconds / 60 % 60);
        $secs = floor($seconds % 60);
        return sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
    }


    public static function createQCM(int $userId){
        $questions = Question::query()->orderByRaw("RAND()")->limit(15)->get();
        $qcm = self::insert([
            'user_id' => $userId,
            'created_at' => Carbon::now(),
        ]);
        $id = DB::getPdo()->lastInsertId();
        $qcm = self::find($id);
        foreach ($questions as $question){
            DB::table("qcm_questions")->insert(['question_id' => $question->id, 'cqm_id' => $qcm->id]);
        }
        return $qcm->id;
    }
}
