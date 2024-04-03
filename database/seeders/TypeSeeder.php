<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            'Individual',
            'Four Hands',
            'Group Projects',
        ];

        foreach ( $types as $item ){
            $newType = new Type();

            $newType->type = $item;

            $newType->save();
        }
    }
}
