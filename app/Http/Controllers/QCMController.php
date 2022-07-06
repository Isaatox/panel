<?php

namespace App\Http\Controllers;

use App\Models\QCM;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QCMController extends Controller
{

    public function index(QCM $qcm){
        abort_if($qcm->user_id != Auth::id(), 404);
        if ($qcm->end_at != null){
            return redirect()->route('home')->with('status', 'Vous avez plus la possibilité d\'accéder à ce QCM.');
        }
        return view('qcm', compact('qcm'));
    }

    public function create(){
        $qcm = QCM::where("user_id",Auth::id())->count();
        $first = QCM::where("user_id",Auth::id())->where("successfully", true)->count();
        if ($first == 1){
            return redirect()->route('home')->with('status', 'Vous avez déjà été validé.');

        }
        if (Auth::user()->discord_id == null){
            return redirect()->route('home')->with('status', 'Vous devez être synchronisé avec Discord pour faire le QCM.');
        }
        if ($qcm >= 3){
            return redirect()->route('home')->with('status', 'Vous avez la possibilité de faire 3 fois ce QCM.');
        }
        $id = QCM::createQCM(Auth::id());
        return redirect()->route('qcm', ['qcm' => $id])->with('status', 'Veuillez répondre à ces 15 questions pour remplir ce QCM.');
    }

    public function store(QCM $qcm, Request  $request){
        abort_if($qcm->user_id != Auth::id(), 404);
        $params = $request->all();
        unset($params['_token']);
        $keys = collect($params)->mapWithKeys(function($value, $key) use ($params){
              [$indice, $qId, $random] = explode('-', $key);
              return [$qId => collect($params)->keys()->filter(function($value) use ($qId,$random){
                  return Str::endsWith($value, $random);
              })->map(function($value) {
                  return (int)explode('-', $value)[0];
              })->unique()
                  ->toArray()
              ];
        })->toArray();
        $questions = collect($qcm->questions())->mapWithKeys(function($value){
            return [$value->id => collect(explode(',', $value->validate))->map(function($key) { return (int)$key;})->toArray()];
        })->toArray();

        $i = 0;
        foreach ($questions as $k => $question){
            if (empty( $keys[$k] ?? [])){
                continue;
            }
            sort($question);
            sort($keys[$k]);
            if($this->equals($question, $keys[$k] ?? [])){
                $i++;
                DB::table("qcm_questions")->where("cqm_id", $qcm->id)->where("question_id", $k)->update(['successfully' => true]);
            }
        }
        $qcm->validatedcount = $i;
        $qcm->end_at = Carbon::now();

        if ($i >= 10){
            $qcm->successfully = true;
        } else {
            $qcm->successfully = false;
        }
        $qcm->save();
        $user = Auth::user();
        $user->can_have_role = true;
        $user->save();
        return redirect()->route('home')->with('status', 'Formulaire terminé.');
    }


    function equals($a, $b) {
        return (
            is_array($a)
            && is_array($b)
            && count($a) == count($b)
            && array_diff($a, $b) === array_diff($b, $a)
        );
    }
}


