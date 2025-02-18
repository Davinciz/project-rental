@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <main class="relative">
        <img src="{{ asset('image/landing 1.png') }}" class="w-full h-[400px] md:h-[500px] object-cover" alt="Landing Image">
        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="text-white text-center p-6">
                <h1 class="text-2xl md:text-4xl font-bold mb-4">
                    Selamat Datang, {{ Auth::check() ? Auth::user()->name : 'Guest' }}
                </h1>
                <p class="mb-6">Rasakan serunya bermain Playstation di rumah bersama teman atau keluarga.</p>
                <a href="{{ route('rental.index') }}"
                    class="bg-[#605DEC] hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                    <span>Rental Disini</span>
                </a>
            </div>
        </div>
    </main>

    @include('sections.playstation')
    @include('sections.television')
    @include('sections.information')
@endsection
