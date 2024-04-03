<?php

namespace Database\Seeders;

use App\Models\Tecnology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TecnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tecnologies = [
            'laravel',
            'css',
            'js',
            'vue',
            'html'
        ];

        foreach($tecnologies as $element){
            $new_tecnology = new Tecnology();
            $new_tecnology->name = $element;
            $new_tecnology->save();
        }
    }
}
