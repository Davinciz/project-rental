@extends('layouts.app')

@section('title', 'Account')

@section('content')

    <main class="p-4 md:p-8 bg-[#DEDDEB] bg-opacity-50">
        <div class="text-gray-700 mb-4 ">
            <h1 class="text-2xl font-bold">
                My Account
            </h1>
            <p>
                <a href="/" class=" hover:underline">Homepage</a> &gt; My Account
            </p>
        </div>
    </main>

    @include('sections.sidebar')
    @include('sections.profile')
    @include('sections.history')

@endsection
