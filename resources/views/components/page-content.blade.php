@props(['title', 'isCreate' => false, 'createLink' => '', 'isBack' => false, 'isBackLink' => url()->previous()])
@extends('admin.layout.app')

@push('css')
    @if (isset($css))
        {{ $css }}
    @endif
@endpush

@section('contents')
    <div class="container-fluid">
        <div class="row">
            <x-breadcrumb title="{{ $title }}" isCreate="{{ $isCreate }}" createLink="{{ $createLink }}"
                isBack="{{ $isBack }}" isBackLink="{{ $isBackLink }}">
                @if (isset($breadcrumb))
                    {{ $breadcrumb }}
                @endif
            </x-breadcrumb>
            @if (session('success'))
                <div class="col-lg-12 mt-2 session-success" id="session-success">
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                </div>
            @endif
            {{ $slot }}
        </div>
    </div>
@endsection

@push('scripts')
    @if (isset($scripts))
        {{ $scripts }}
    @endif
@endpush
