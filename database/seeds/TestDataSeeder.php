<?php

use App\User;
use App\Conference;
use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $this->testUsers();
        $this->testConferences();
    }

    private function testUsers() {
        $users = [
            [
                'name'     => "admin",
                'email'    => "admin@gbforum.uk",
                'password' => Hash::make('password')
            ]
        ];

        User::insert($users);
    }

    private function testConferences() {
        $fields = [
            'name' => 'Test Conference',
            'url_slug' => 'Test Conference',
            'frontend_theme' => '',
            'backend_theme' => 'purple',
            'enabled' => '1',
            'published' => '1',
        ];

        $conference = new Conference();

        foreach($fields as $k => $v) {
            $conference->$k = $v;
        }

        return $conference->save();
    }
}
