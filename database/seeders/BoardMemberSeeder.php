<?php

namespace Database\Seeders;

use App\Models\BoardMember;
use Illuminate\Database\Seeder;

class BoardMemberSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            ['name' => 'Mikko Lauhakari', 'role' => 'Ordförande', 'company' => 'Glesys AB', 'image_path' => 'mikko.jpeg', 'sort_order' => 0],
            ['name' => 'Isak Berglind', 'role' => 'Sekreterare', 'company' => 'CampusBokhandel', 'image_path' => 'isak.jpeg', 'sort_order' => 1],
            ['name' => 'Martin Danielsson', 'role' => 'Kassör', 'company' => 'ePark', 'image_path' => 'martin.jpeg', 'sort_order' => 2],
            ['name' => 'Tommie Lagerroos', 'role' => 'Styrelseledamot', 'company' => 'Techlove', 'image_path' => 'tommie.jpeg', 'sort_order' => 3],
            ['name' => 'Ola Ebbesson', 'role' => 'Styrelseledamot', 'company' => 'Caesar Dev', 'image_path' => 'ola.jpeg', 'sort_order' => 4],
            ['name' => 'Jonatan Alvarsson', 'role' => 'Revisor', 'company' => 'JA Webb', 'image_path' => 'jonatan.jpeg', 'sort_order' => 5],
            ['name' => 'Oliver Scase', 'role' => 'Suppleant', 'company' => 'Techlove', 'image_path' => 'oliver.jpeg', 'sort_order' => 6],
        ];

        foreach ($members as $member) {
            BoardMember::create($member);
        }
    }
}
