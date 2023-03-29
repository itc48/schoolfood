<?php

namespace App\Console\Commands;

use App\Builders\UserBuilder;
use App\Exports\SchoolsUsersExport;
use App\Models\School;
use App\Models\UserRole;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class CreateSchoolchildrenUsers extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schoolchildren:create';

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
        $schoolchildren_role = UserRole::whereCode('SCHOOLCHILDREN')->firstOrFail();
        $schools = School::all();
        $users = [
            [
                'Логин',
                'Пароль',
                'Заголовок школы'
            ]
        ];
        $user_builder = new UserBuilder();

        foreach ($schools as $school) {
            $user = [
                'name' => Str::random(8),
                'password' => Str::random(16),
                'school_title' => $school->title,
            ];

            $user_builder
                ->createEmpty()
                ->setName($user['name'])
                ->setPassword($user['password'])
                ->setRoleId($schoolchildren_role->id)
                ->setSchoolUuid($school->uuid)
                ->save();

            $users[] = $user;
        }

        $export = new SchoolsUsersExport();
        $export->users = $users;

        Excel::store($export, 'new_schoolchildren_users.xlsx');
        $this->info('Success creating users');
        return 0;
    }
}
