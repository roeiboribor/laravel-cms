<?php

namespace App\Http\Livewire;

use App\Models\Page;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Pages extends Component
{
    use WithPagination;
    public $slug;
    public $title;
    public $content;
    public $modelId;
    public $defaultPage;
    public $isDelete = false;
    public $modalFormVisible = true;

    /**
     * Validation from livewire
     *
     * @return void
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'slug' => ['required', Rule::unique('pages', 'slug')->ignore($this->modelId)],
            'content' => 'required',
        ];
    }

    public function mount()
    {
        // Resets the pagination
        $this->resetPage();
    }

    /**
     * updatedVARIABLE_NAME is a livewire function for wire:model
     *
     * @param  mixed $value
     * @return void
     */
    public function updatedTitle($value)
    {
        $this->generateSlug($value);
    }

    /**
     * Format the title value into a slug
     *
     * @param  mixed $value
     * @return void
     */
    public function generateSlug($value)
    {
        $process1 = str_replace(' ', '-', $value);
        $process2 = strtolower($process1);
        $this->slug = $process2;
    }

    /**
     * Show modal when create button is clicked
     *
     * @return void
     */
    public function createShowModal()
    {
        $this->resetValidation();
        $this->clearForm();
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
        $this->clearForm();
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
     * Create / Insert new page data
     *
     * @return void
     */
    public function createPage()
    {
        $this->validate();
        Page::create($this->modelData());
        $this->modalFormVisible = false;
        $this->clearForm();
    }

    /**
     * Get all the Page table
     *
     * @return void
     */
    public function readPage()
    {
        return Page::paginate(10);
    }

    /**
     * Update the form
     *
     * @return void
     */
    public function updatePage()
    {
        $this->validate();
        Page::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
        $this->clearForm();
    }

    public function deletePage()
    {
        Page::destroy($this->modelId);
        $this->modalFormVisible = false;
        $this->resetPage();
        $this->clearForm();
    }

    /**
     * Clear the form field
     *
     * @return void
     */
    public function clearForm()
    {
        $this->title = null;
        $this->slug = null;
        $this->content = null;
        $this->modelId = null;
        $this->isDelete = false;
    }

    /**
     * The data for the model
     *
     * @return title,slug,content
     */
    public function modelData()
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'default_page' => $this->defaultPage,
        ];
    }

    /**
     * Loads the data based on modalId
     *
     * @return void
     */
    public function loadModel()
    {
        $data = Page::find($this->modelId);
        $this->title = $data->title;
        $this->slug = $data->slug;
        $this->content = $data->content;
    }

    public function render()
    {
        return view('livewire.pages', [
            'data' => $this->readPage()
        ]);
    }
}
