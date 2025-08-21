<?php

namespace App\Livewire;

use Livewire\Component;

class About extends Component
{
    public array $statistics = [];

    public array $testimonials = [];

    public int $currentTestimonial = 0;

    public function mount()
    {
        $this->statistics = [
            //            [
            //                'number' => '0',
            //                'label' => 'Community Members',
            //                'icon' => '👥'
            //            ],
        ];

        $this->testimonials = [
            //            [
            //                'quote' => '',
            //                'author' => '',
            //                'role' => ''
            //            ],
        ];
    }

    public function nextTestimonial()
    {
        if ($this->currentTestimonial < count($this->testimonials) - 1) {
            $this->currentTestimonial++;
        } else {
            $this->currentTestimonial = 0;
        }
    }

    public function prevTestimonial()
    {
        if ($this->currentTestimonial > 0) {
            $this->currentTestimonial--;
        } else {
            $this->currentTestimonial = count($this->testimonials) - 1;
        }
    }

    public function render()
    {
        return view('livewire.about');
    }
}
