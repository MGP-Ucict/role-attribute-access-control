<?php

namespace LaravelHrabac\AccessControl\Commands;

use Illuminate\Console\Command;

class LaravelrolesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravelroles:seeder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seeds Laravelroles Data';

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
		$this->call('db:seed', ['--class'=>'UsersSeeder']);
		$this->call('db:seed', ['--class'=>'RoleSeeder']);
		$this->call('db:seed', ['--class'=>'RolesUsersSeeder']);
		$this->call('db:seed', ['--class'=>'PermissionsSeeder']);
    }
}
