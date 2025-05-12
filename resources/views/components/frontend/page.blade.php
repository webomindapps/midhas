@extends('frontend.layouts.applayout')


@if (isset($css))
    @push('css')
        {{ $css }}
    @endpush
@endif

@if (isset($title))
    @section('title') {{ $title }}  @endsection
@else
    @section('title') Midhas-Furniture @endsection
@endif


@if (isset($meta_items))
    @section('meta-tags')
        {{ $meta_items }}
    @endsection
@else
    @section('meta-tags')
        <meta name="description"
            content="Midhas Is An Authorized Dealer And All Products Are Covered By Full Manufacturer's Warranty. Midhas Has Been A Well Known Name For Furniture Matress Business  Since Many Years. Midhas Only Sells Brand New Factory Sealed Products. We Never Sell Refurbished, Used, Or Out-Of-Box Unit. All Of Our Products Come With One Year Parts And Labour Warranty From Manufacturers.">
        <meta name="keywords" content="Midhas">
    @endsection
@endif


@section('main-content')
    {{ $slot }}
@endsection


@if (isset($scripts))
    @push('scripts')
        {{ $scripts }}
    @endpush
@endif
