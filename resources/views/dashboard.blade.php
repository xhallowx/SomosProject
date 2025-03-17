@extends('layouts.app')
@section('content')

<h2 class="dashboard">
    {{ __('Dashboard') }}
</h2>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class=" dark:bg-black overflow-hidden shadow-sm sm:rounded-lg welcome">
            <div class="p-6 text-gray-900 dark:text-gray-100 text texto-largo">
                <p style="font-size: 20px; filter:drop-shadow(1.5px 1.5px 1.5px #000);">Welcome <strong>{{ optional(auth()->user())->name ?? 'Invitado' }}</strong> to Somos Project!</p>
                <br>
                <div style="border: 1px solid #222; padding: 5px; background: #333; border-radius: 10px; filter: drop-shadow(1px 1px 1px #000);">
                    <p style="font-size: 16px;">A dedicated website for managing your projects and assigning tasks.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="circle" id="circle">
    <div class="section-text">
        <h2 class="somos">Somos Network...<br /></h2>
    </div>
    <div id="mask" class="mask">
        <div class="section">
        <h2 class="somos">Internet but better!</h2>
        </div>
    </div>
</section>
@endsection