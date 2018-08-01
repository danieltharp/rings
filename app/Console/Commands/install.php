<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Database;
use Illuminate\Support\Facades\DB;

class install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rings:install {--force : Empty the databases table in Rings and start from scratch.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Provide details of your initial realm servers.';

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
     * @return mixed
     */
    public function handle()
    {
        if(Database::count() > 0)
            {
                if(!$this->option('force')) {
                    $this->info("Databases already present in Rings, use 'php artisan rings:install --force' to overwrite.");
                    return 0;
                }

                else {
                    $this->info("WARNING: --force option enabled. This is a destructive operation when confirmed.");
                }
            }
        $this->info("Welcome to the Rings installer.");
        $this->info("You will need your MySQL information for your character and world server to proceed.");
        $this->info("PLEASE make sure you have filled out your .env file with RINGS_SERVER_ and AUTH_SERVER_ info before proceeding or this will crash.");
        $char_ip = $this->anticipate("What is the IP of the CHARACTER server MySQL database?", ['127.0.0.1'], '127.0.0.1');
        $char_port = $this->anticipate("What is the port MySQL is listening on for the CHARACTER server?", ['3306'], '3306');
        $char_name = $this->anticipate("What is the name of the MySQL database for the CHARACTER server?", ['characters'], 'characters');
        $char_username = $this->anticipate("What is the MySQL username for the CHARACTER server?", ['trinity'], 'trinity');
        $char_password = $this->anticipate("What is the MySQL password for the CHARACTER server?", ['trinity'], 'trinity');
        $world_ip = $this->anticipate("What is the IP of the WORLD server MySQL database?", ['127.0.0.1'], '127.0.0.1');
        $world_port = $this->anticipate("What is the port MySQL is listening on for the WORLD server?", ['3306'], '3306');
        $world_name = $this->anticipate("What is the name of the MySQL database for the WORLD server?", ['world'], 'world');
        $world_username = $this->anticipate("What is the MySQL username for the WORLD server?", ['trinity'], 'trinity');
        $world_password = $this->anticipate("What is the MySQL password for the WORLD server?", ['trinity'], 'trinity');
        $this->info("Character server: $char_username:$char_password@$char_ip:$char_port using database $char_name");
        $this->info("World server: $world_username:$world_password@$world_ip:$world_port using database $world_name");
        if($this->confirm("Does everything look correct?")) {
            if($this->option('force')) {
                $this->info("--force mode: Emptying databases table.");
                DB::table('databases')->truncate();
            }
            $this->info("Saving...");
            $cserver = new Database([
                'realmid' => '1',
                'address' => $char_ip,
                'port' => $char_port,
                'name' => $char_name,
                'username' => $char_username,
                'password' => $char_password,
                'type' => 'c'
            ]);
            $cserver->save();
            $this->info("Saved character server.");
            $wserver = new Database([
                'realmid' => '1',
                'address' => $world_ip,
                'port' => $world_port,
                'name' => $world_name,
                'username' => $world_username,
                'password' => $world_password,
                'type' => 'w'
            ]);
            $wserver->save();
            $this->info("Saved world server.");
            $this->info("Done! You may now log in.");
        }
        else {
            $this->info("Please rerun 'php artisan rings:install'");
            return 0;
        }
    }
}
