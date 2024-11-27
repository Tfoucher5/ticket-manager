<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Silber\Bouncer\BouncerFacade as Bouncer;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Créer les rôles
        Bouncer::role()->firstOrCreate(['name' => 'admin']);
        Bouncer::role()->firstOrCreate(['name' => 'developpeur']);
        Bouncer::role()->firstOrCreate(['name' => 'client']);

        // Créer un utilisateur admin
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('totototo'),
        ]);
        Bouncer::assign('admin')->to($admin);


        // Créer un utilisateur développeur
        $developer = User::create([
            'name' => 'Developer User',
            'email' => 'developer@example.com',
            'password' => bcrypt('totototo'),
        ]);
        Bouncer::assign('developpeur')->to($developer);

        // Créer un utilisateur client
        $client = User::create([
            'name' => 'Client User',
            'email' => 'client@example.com',
            'password' => bcrypt('totototo'),
        ]);
        Bouncer::assign('client')->to($client);
    }
}


