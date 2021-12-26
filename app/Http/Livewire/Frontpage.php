<?php

namespace App\Http\Livewire;

use App\Models\Page;
use Livewire\Component;

class Frontpage extends Component
{
    public $title;
    public $content;

    public function mount($urlslug = null)
    {
        $this->retrieveContent($urlslug);
    }

    public function retrieveContent($urlSlug)
    {
        if (empty($urlSlug)) {
            $data = Page::where('default_page', 'home')->first();
        } else {
            $data = Page::where('slug', $urlSlug)->first();
            $data = $data ??
                Page::where('default_page', 'error')->first();;
        }

        $this->title = $data->title;
        $this->content = $data->content;
    }

    public function render()
    {
        return view('livewire.frontpage')->layout('layouts.frontpage');
    }
}
