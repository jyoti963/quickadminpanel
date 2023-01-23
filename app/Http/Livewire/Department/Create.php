<?php

namespace App\Http\Livewire\Department;

use App\Models\Country;
use App\Models\Department;
use Livewire\Component;

class Create extends Component
{
    public Department $department;

    public array $listsForFields = [];

    public function mount(Department $department)
    {
        $this->department         = $department;
        $this->department->status = 'active';
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.department.create');
    }

    public function submit()
    {
        $this->validate();

        $this->department->save();

        return redirect()->route('admin.departments.index');
    }

    protected function rules(): array
    {
        return [
            'department.name' => [
                'string',
                'required',
                'unique:departments,name',
            ],
            'department.status' => [
                'required',
                'in:' . implode(',', array_keys($this->listsForFields['status'])),
            ],
            'department.country_id' => [
                'integer',
                'exists:countries,id',
                'required',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['status']  = $this->department::STATUS_SELECT;
        $this->listsForFields['country'] = Country::pluck('name', 'id')->toArray();
    }
}
