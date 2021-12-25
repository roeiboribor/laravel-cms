<?php

namespace App\Http\Livewire;

use App\Models\Page;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Pages extends Component
{
    public $slug;
    public $title;
    public $content;
    public $modalFormVisible = false;

    /**
     * Show modal when create button is clicked
     *
     * @return void
     */
    public function createShowModal()
    {
        $this->modalFormVisible = true;
    }

    /**
     * Validation from livewire
     *
     * @return void
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'slug' => ['required', Rule::unique('pages', 'slug')],
            'content' => 'required',
        ];
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

    public function generateSlug($value)
    {
        $process1 = str_replace(' ', '-', $value);
        $process2 = strtolower($process1);
        $this->slug = $process2;
    }

    public function createPage()
    {
        $this->validate();
        Page::create($this->modelData());
        $this->modalFormVisible = false;
        $this->clearForm();
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
        ];
    }

    public function clearForm()
    {
        $this->title = null;
        $this->slug = null;
        $this->content = null;
    }

    public function render()
    {
        return view('livewire.pages');
    }
}
