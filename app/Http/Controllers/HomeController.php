<?php

namespace App\Http\Controllers;

use App\Discord;
use App\Models\QCM;
use App\Models\Question;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $qcm = QCM::where("user_id",Auth::id())->get();
        return view('home', compact('qcm'));
    }

    public function discord(){

        return Socialite::driver('discord')->redirect();
    }



    public function admin(){
        $qcm = QCM::all();
        $users = User::all();
        $questions = Question::all();
        return view('admin', compact('qcm', 'users', 'questions'));
    }


    public function show(Question $question){
        return view('question', compact('question'));
    }


    public function edit(Question $question, Request $request){
        $this->validate($request, [
            'replies' => 'required',
            'answer' => 'required',
            'validate' => 'required'
        ]);
        $question->replies = $request->replies;
        $question->answer = $request->answer;
        $question->validate = $request->validate;
        $question->save();
        return redirect()->route('admin')->with('status', 'Question modifié.');
    }

    public function view(){
        return view('questionAdd');
    }

    public function add(Request $request){
        
        Question::create([
            'answer' => $request->answer,
            'replies' =>  $request->replies,
            'validate' =>  $request->validate
        ]);
        return redirect()->route('admin')->with('status', 'Question ajoutée.');

    }

    public function supr(){
        $id = request("question");
        Question::where('id', $id)
        ->delete();
        return redirect()->route('admin')->with('status', 'Question supprimée.');

    }

    public function callback(){
        try {
        $user = Socialite::driver('discord')->user();
        $snow = $this->getSnowflakeTimestamp($user->getId());
        $snow = Carbon::now()->setTimestamp($snow);
        if ($snow->addDays(31)->isPast()){
            Auth::user()->discord_id = $user->getId();
            Auth::user()->save();
            return redirect()->route('home')->with('status', 'Discord est bien synchronisé.');
        } else {
            return redirect()->route('home')->with('status', 'Votre compte discord doit être âgé d\'au moins 31 jours pour être synchronisé.');
        }
        } catch (\Exception $e){
            return redirect()->route('home')->with('status', 'Oups quelque chose s\'est mal passé veuillez vous re synchroniser.');
        }

    }

    public function getSnowflakeTimestamp(string $snowflake)
    {
        if (\PHP_INT_SIZE === 4) { //x86
            $binary = \str_pad(\base_convert($snowflake, 10, 2), 64, 0, \STR_PAD_LEFT);
            $time = \base_convert(\substr($binary, 0, 42), 2, 10);
            $timestamp = (float) ((((int) \substr($time, 0, -3)) + 1420070400).'.'.\substr($time, -3));
            $workerID = (int) \base_convert(\substr($binary, 42, 5), 2, 10);
            $processID = (int) \base_convert(\substr($binary, 47, 5), 2, 10);
            $increment = (int) \base_convert(\substr($binary, 52, 12), 2, 10);
        } else { //x64
            $snowflake = (int) $snowflake;
            $time = (string) ($snowflake >> 22);
            $timestamp = (float) ((((int) \substr($time, 0, -3)) + 1420070400).'.'.\substr($time, -3));
            $workerID = ($snowflake & 0x3E0000) >> 17;
            $processID = ($snowflake & 0x1F000) >> 12;
            $increment = ($snowflake & 0xFFF);
        }
        if ($timestamp < 1420070400 || $workerID < 0 || $workerID >= 32 || $processID < 0 || $processID >= 32 || $increment < 0 || $increment >= 4096) {
            return null;
        }
    
        return $timestamp;
    }
    
}
