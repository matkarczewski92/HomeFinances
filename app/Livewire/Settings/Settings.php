<?php

namespace App\Livewire\Settings;

use App\Models\Category;
use Livewire\Component;

class Settings extends Component
{
    public $iName;
    public $cName;
    public $editId;
    public $editName;

    public function render()
    {
        return view('livewire.settings.settings', [
            'category' => Category::all(),
        ]);
    }

    public function addCategory()
    {
        if (!empty($this->cName) or !empty($this->iName)) {
            $category = new Category();
            $category->name = (!empty($this->cName)) ? $this->cName : $this->iName;
            $category->type = (!empty($this->cName)) ? 'c' : 'i';
            $category->save();
            $this->reset('cName');
            $this->reset('iName');
        }
    }

    public function delete(int $id)
    {
        $category = Category::where('id', $id)->delete();
    }

    public function editMode(int $id)
    {
        $category = Category::where('id', $id)->first();

        $this->editId = $category->id;
        $this->editName = $category->name;
    }

    public function save()
    {
        $category = Category::find($this->editId);
        $category->name = $this->editName;
        $category->save();
        $this->editId = '';
    }
}
