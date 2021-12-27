<?php

namespace App\Http\Livewire;

use App\Models\NavigationMenu;
use Livewire\Component;
use Livewire\WithPagination;

class NavigationMenus extends Component
{
    use WithPagination;
    public $modelId;
    public $label;
    public $slug;
    public $sequence = 1;
    public $type = 'sidebarNav';
    public $isDelete = false;
    public $modalFormVisible = false;

    public function read()
    {
        return NavigationMenu::paginate(5);
    }

    public function render()
    {
        return view('livewire.navigation-menus', [
            'data' => $this->read(),
        ]);
    }
}
