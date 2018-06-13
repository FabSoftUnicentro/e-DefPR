<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Role;
class RoleTableSeeder extends Seeder{
    public function run()
    {
        if (App::environment() === 'production') {
            exit('I just stopped you getting fired.');
        }
        DB::table('role')->truncate();
        Role::create([
            'id'            => 1,
            'name'          => 'Defender',
            'description'   => 'Full access'
        ]);
        Role::create([
            'id'            => 2,
            'name'          => 'Legal advisor',
            'description'   => 'Access to the processes that performed care. This includes the process status and the data of the person assisted. Can not view sensitive data such as consultation with a psychologist.'
        ]);
        Role::create([
            'id'            => 3,
            'name'          => 'Psychologist',
            'description'   => 'Has access to the data of the assistants served by him.'
        ]);
        Role::create([
            'id'            => 4,
            'name'          => 'Social Worker',
            'description'   => 'Has access only to the data of the assistants served by them (personal and socioeconomic data).'
        ]);
        Role::create([
            'id'            => 5,
            'name'          => 'Admnistrative technician',
            'description'   => 'Access to the data of the attendees attended in general'
        ]);
        Role::create([
            'id'            => 6,
            'name'          => 'Administrative Technician in Law',
            'description'   => 'has access to the data of the attendees attended in general and has the processes of those attended by them.'
        ]);

        Role::create([
            'id'            => 7,
            'name'          => 'Law Trainees',
            'description'   => 'Access to the processes that performed care. This includes the process status and the data of the person assisted. Can not view sensitive data such as consultation with a psychologist.'
        ]);
        Role::create([
            'id'            => 8,
            'name'          => 'High School Trainees',
            'description'   => 'Has access only to the personal data of the assisted and some internal information, such as last person to perform the service.'
        ]);
    }
}
