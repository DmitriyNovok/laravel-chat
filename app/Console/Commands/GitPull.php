<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GitPull extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'git:pull {branch}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get changes from branch';

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
     */
    public function handle()
    {
        $branch = $this->argument('branch');

        $this->info(shell_exec('php artisan down'));
        $this->info(shell_exec('git clean -f -d'));
        $this->info(shell_exec('git reset --hard HEAD'));
        $this->info(shell_exec("git checkout $branch"));
        $this->info(shell_exec("git pull origin $branch"));
        $this->info(shell_exec('php artisan migrate --force'));
        $this->info(shell_exec('php artisan config:clear'));
        $this->info(shell_exec('php artisan up'));
    }
}
