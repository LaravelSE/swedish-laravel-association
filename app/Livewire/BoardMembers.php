<?php

namespace App\Livewire;

use Livewire\Component;

class BoardMembers extends Component
{
    public array $boardMembers = [];

    public function mount()
    {
        $this->boardMembers = [
            [
                'name' => 'Mikko Lauhakari',
                'role' => 'Ordförande',
                'company' => 'Glesys AB',
                'image' => 'mikko.jpeg',
            ],
            [
                'name' => 'Isak Berglind',
                'role' => 'Sekreterare',
                'company' => 'CampusBokhandel',
                'image' => 'isak.jpeg',
            ],
            [
                'name' => 'Martin Danielsson',
                'role' => 'Kassör',
                'company' => 'ePark',
                'image' => 'martin.jpeg',
            ],
            [
                'name' => 'Tommie Lagerroos',
                'role' => 'Styrelseledamot',
                'company' => 'Techlove',
                'image' => 'tommie.jpeg',
            ],
            [
                'name' => 'Ola Ebbesson',
                'role' => 'Styrelseledamot',
                'company' => 'Caesar Dev',
                'image' => 'ola.jpeg',
            ],
            [
                'name' => 'Jonatan Alvarsson',
                'role' => 'Revisor',
                'company' => 'JA Webb',
                'image' => 'jonatan.jpeg',
            ],
            [
                'name' => 'Oliver Scase',
                'role' => 'Suppleant',
                'company' => 'Techlove',
                'image' => 'oliver.jpeg',
            ],
        ];
    }

    public function render()
    {
        return view('livewire.board-members');
    }
}
