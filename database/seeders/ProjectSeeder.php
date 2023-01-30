<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // Con questo comando ogni volta che lancio il seeder mi cancella i project precedenti
        Project::truncate();

        for ($i = 0; $i < 10; $i++) {
            $type = Type::inRandomOrder()->first();

            $new_project = new Project();
            $new_project->title = $faker->sentence();
            $new_project->description = $faker->text();
            $new_project->slug = Str::slug($new_project->title, '-');
            $new_project->type_id = $type->id;
            $new_project->save();
        }
    }
}
