@extends('layouts.app')

@section('title', 'Detail')

@section('content')
<main class="p-4 md:p-8 bg-[#DEDDEB] bg-opacity-50">
    <div class="text-gray-700 mb-4 ">
        <h1 class="text-2xl font-bold">
            Detail Rental
        </h1>
        <p>
            <a href="/" class="hover:underline">Homepage</a> &gt; Detail
        </p>
    </div>
</main>

    @include('sections.rental-detail')
@endsection
