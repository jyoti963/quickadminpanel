<?php

namespace App\Http\Livewire\Employee;

use App\Models\Department;
use App\Models\Employee;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Edit extends Component
{
    public Employee $employee;

    public array $mediaToRemove = [];

    public array $listsForFields = [];

    public array $mediaCollections = [];

    public function addMedia($media): void
    {
        $this->mediaCollections[$media['collection_name']][] = $media;
    }

    public function removeMedia($media): void
    {
        $collection = collect($this->mediaCollections[$media['collection_name']]);

        $this->mediaCollections[$media['collection_name']] = $collection->reject(fn ($item) => $item['uuid'] === $media['uuid'])->toArray();

        $this->mediaToRemove[] = $media['uuid'];
    }

    public function getMediaCollection($name)
    {
        return $this->mediaCollections[$name];
    }

    public function mount(Employee $employee)
    {
        $this->employee = $employee;
        $this->initListsForFields();
        $this->mediaCollections = [
            'employee_image' => $employee->image,
        ];
    }

    public function render()
    {
        return view('livewire.employee.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->employee->save();
        $this->syncMedia();

        return redirect()->route('admin.employees.index');
    }

    protected function syncMedia(): void
    {
        collect($this->mediaCollections)->flatten(1)
            ->each(fn ($item) => Media::where('uuid', $item['uuid'])
            ->update(['model_id' => $this->employee->id]));

        Media::whereIn('uuid', $this->mediaToRemove)->delete();
    }

    protected function rules(): array
    {
        return [
            'employee.department_id' => [
                'integer',
                'exists:departments,id',
                'required',
            ],
            'employee.name' => [
                'string',
                'required',
                'unique:employees,name,' . $this->employee->id,
            ],
            'employee.email' => [
                'email:rfc',
                'required',
                'unique:employees,email,' . $this->employee->id,
            ],
            'employee.phone' => [
                'string',
                'required',
            ],
            'mediaCollections.employee_image' => [
                'array',
                'required',
            ],
            'mediaCollections.employee_image.*.id' => [
                'integer',
                'exists:media,id',
            ],
            'employee.address' => [
                'string',
                'required',
            ],
            'employee.salary' => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'required',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['department'] = Department::pluck('name', 'id')->toArray();
    }
}
