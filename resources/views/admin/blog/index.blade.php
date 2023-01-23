@extends('layouts.admin')
@section('content')
<div class="row">
    @if (session()->has('msg'))
            <div class="alert alert-success">
                {{ session('msg') }}
            </div>
    @endif
    <div class="card bg-white">
        <div class="card-header border-b border-blueGray-200">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('cruds.blog.title_singular') }}
                    {{ trans('global.list') }}
                </h6>

                @can('blog_create')
                    <a class="btn btn-indigo" href="{{ route('admin.blogs.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.blog.title_singular') }}
                    </a>
                @endcan
            </div>
        </div>
        @livewire('blog.index')

    </div>
</div>
@endsection
