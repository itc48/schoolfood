<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class DeleteSchoolchildrenUsers extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schoolchildren:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        User::join('user_roles', 'users.role_id', '=', 'user_roles.id')
            ->whereCode('SCHOOLCHILDREN')
            ->delete();

        $this->info('Success deleting users');
        return 0;
    }
}
