<?php

namespace App\Console\Commands;

use App\Exports\SchoolsUsersExport;
use App\Models\School;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class GenerateSchoolsUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schools:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generating users for all schools';

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
        $schools = School::all();

        try {
            $users = [
                [
                    'Логин',
                    'Пароль',
                    'UUID школы',
                    'Заголовок школы'
                ]
            ];

            foreach ($schools as $school) {
                $user = [
                    'name' => Str::random(8),
                    'password' => Str::random(16),
                    'school_uuid' => $school->uuid,
                    'school_title' => $school->title,
                ];

                User::create([
                    'name' => $user['name'],
                    'password' => bcrypt($user['password']),
                    'school_uuid' => $user['school_uuid'],
                    'role_id' => 3
                ]);

                $users[] = $user;
            }

            $export = new SchoolsUsersExport();
            $export->users = $users;

            Excel::store($export, 'users.xlsx');

            $this->info('Successful generating schools users');
        } catch (\Exception $e) {
            $this->error($e);
        }


        return 0;
    }
}
