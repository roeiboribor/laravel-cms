<?php

namespace App\Http\Livewire;

use App\Models\NavigationMenu;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class NavigationMenus extends Component
{
    use WithPagination;
    public $modelId;
    public $label;
    public $slug;
    public $sequence = 1;
    public $type = 'sidebarNav';
    public $isDelete = false;
    public $modalFormVisible;

    /**
     * Validation from livewire
     *
     * @return void
     */
    public function rules()
    {
        return [
            'label' => 'required',
            'slug' => ['required', Rule::unique('navigation_menus', 'slug')->ignore($this->modelId)],
            'type' => 'required',
            'sequence' => 'required',
        ];
    }

    /**
     * updatedVARIABLE_NAME is a livewire function for wire:model
     *
     * @param  mixed $value
     * @return void
     */
    public function updatedLabel($value)
    {
        $this->slug = Str::slug($value);
    }

    /**
     * Create / Insert new Menu
     *
     * @return void
     */
    public function create()
    {
        $this->validate();
        NavigationMenu::create($this->modelData());
        $this->modalFormVisible = false;
        $this->reset();
    }

    /**
     * Update the form
     *
     * @return void
     */
    public function update()
    {
        $this->validate();
        NavigationMenu::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
        $this->reset();
    }

    /**
     * Delete Navigation Menu
     *
     * @return void
     */
    public function delete()
    {
        NavigationMenu::destroy($this->modelId);
        $this->modalFormVisible = false;
        $this->resetPage();
        $this->reset();
    }

    /**
     * Loads all navigation menus and paginate them
     *
     * @return void
     */
    public function read()
    {
        return NavigationMenu::paginate(5);
    }

    /**
     * The data for the model
     *
     * @return label,slug,type,sequence
     */
    public function modelData()
    {
        return [
            'label' => $this->label,
            'slug' => $this->slug,
            'type' => $this->type,
            'sequence' => $this->sequence,
        ];
    }

    /**
     * Show modal when create button is clicked
     *
     * @return void
     */
    public function createShowModal()
    {
        // Livewire functions
        $this->resetValidation();
        $this->reset();

        $this->modalFormVisible = true;
    }

    /**
     * update / fill up the modal based on id
     *
     * @param  mixed $id
     * @return void
     */
    public function updateShowModal($id)
    {
        $this->resetValidation();
        $this->reset();
        $this->modelId = $id;
        $this->modalFormVisible = true;
        $this->loadModel();
    }

    /**
     * Show Delete Modal Content
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteShowModal($id)
    {
        $this->modelId = $id;
        $this->modalFormVisible = true;
        $this->isDelete = true;
    }

    /**
     * Loads the data based on modalId
     *
     * @return void
     */
    public function loadModel()
    {
        $data = NavigationMenu::find($this->modelId);
        $this->label = $data->label;
        $this->slug = $data->slug;
        $this->type = $data->type;
        $this->sequence = $data->sequence;
    }

    public function render()
    {
        return view('livewire.navigation-menus', [
            'data' => $this->read(),
        ]);
    }
}
