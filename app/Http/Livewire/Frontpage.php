<?php

namespace App\Http\Livewire;

use App\Models\NavigationMenu;
use App\Models\Page;
use Illuminate\Support\Facades\DB;
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

    /**
     * Get All Sidebar Links
     *
     * @return void
     */
    private function sideBarLinks()
    {
        return NavigationMenu::where('type', 'SidebarNav')->get();
    }

    /**
     * Get All Sidebar Links
     *
     * @return void
     */
    private function topNavLinks()
    {
        return NavigationMenu::where('type', 'TopNav')->get();
    }

    public function render()
    {
        return view('livewire.frontpage', [
            'sidebarLinks' => $this->sideBarLinks(),
            'topNavLinks' => $this->topNavLinks(),
        ])
            ->layout('layouts.frontpage');
    }
}
