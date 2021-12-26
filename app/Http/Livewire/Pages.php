<?php

namespace App\Http\Livewire;

use App\Models\Page;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Pages extends Component
{
    use WithPagination;
    public $slug;
    public $title;
    public $content;
    public $modelId;
    public $defaultPage;
    public $isDelete = false;
    public $modalFormVisible = false;

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
        Str::slug($value);
    }

    /**
     * Format the title value into a slug / Manual Generate Slug
     *
     * @param  mixed $value
     * @return void
     */
    // public function generateSlug($value)
    // {
    //     $process1 = str_replace(' ', '-', $value);
    //     $process2 = strtolower($process1);
    //     $this->slug = $process2;
    // }

    /**
     * Show modal when create button is clicked
     *
     * @return void
     */
    public function createShowModal()
    {
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
     * Create / Insert new page data
     *
     * @return void
     */
    public function createPage()
    {
        $this->validate();
        $this->unassignDefaultPage();
        Page::create($this->modelData());
        $this->modalFormVisible = false;
        $this->reset();
    }

    /**
     * Get all the Page table
     *
     * @return void
     */
    public function readPage()
    {
        return Page::orderByDesc('title')->paginate(10);
    }

    /**
     * Update the form
     *
     * @return void
     */
    public function updatePage()
    {
        $this->validate();
        $this->unassignDefaultPage();
        Page::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
        $this->reset();
    }

    public function deletePage()
    {
        Page::destroy($this->modelId);
        $this->modalFormVisible = false;
        $this->resetPage();
        $this->reset();
    }

    /**
     * Clear the form field / Reset Manual Function
     *
     * @return void
     */
    // public function clearForm()
    // {
    //     $this->title = null;
    //     $this->slug = null;
    //     $this->content = null;
    //     $this->modelId = null;
    //     $this->isDelete = false;
    //     $this->defaultPage = null;
    // }

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
        $this->defaultPage = $data->default_page;
    }

    /**
     * Un Assign the default page
     *
     * @return void
     */
    private function unassignDefaultPage()
    {
        if ($this->defaultPage != null) {

            Page::where('default_page', $this->defaultPage)
                ->update([
                    'default_page' => null
                ]);
        }
    }

    public function render()
    {
        return view('livewire.pages', [
            'data' => $this->readPage()
        ]);
    }
}
