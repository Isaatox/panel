<?php

namespace App\Console\Commands;

use App\Models\User;
use Discord\Discord;
use Discord\WebSockets\Intents;
use Illuminate\Console\Command;

class StartBot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bot:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start le bot';

    protected $roleId = 994219004791115820;



    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     * @throws \Discord\Exceptions\IntentException
     */
    public function handle()
    {
        $start = time();
        $discord = new Discord([
            'token' => config('services.discord.token'),
        ]);

        $discord->on('ready', function (Discord $discord) use ($start) {
            $started = time() - $start;
            dump($started);
            $this->setInterval(function() use ($discord){
                $this->execute2($discord);
            }, 1000 * 5);

        });
        $discord->run();


        return 0;
    }

    private function execute2(Discord $discord){
        $guild = $discord->guilds->first();
        if ($guild == null) return;
        dump($guild->name, $guild->members->get("id", 802678160965369947));
        $users = User::whereNotNull("discord_id")->where("added_role", false)->get();
        $users->map(function (User $user2) use ($discord, $guild){
            dd($guild->members->filter(function($user) use ($user2) {
                return (int)$user->user->id == (int)$user2->discord_id;
            }));
        });
    }


    function setInterval($f, $milliseconds)
    {
        $seconds=(int)$milliseconds/1000;
        while(true)
        {
            $f();
            sleep($seconds);
        }
    }
}
