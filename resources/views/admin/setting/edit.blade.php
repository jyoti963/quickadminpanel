@extends('layouts.admin')
@section('content')
<div class="row">
    @if (session()->has('msg'))
            <div class="alert alert-success">
                {{ session('msg') }}
            </div>
    @endif
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('cruds.setting.title_singular') }}:
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('setting.edit', [$setting])
        </div>
    </div>
</div>
@endsection
