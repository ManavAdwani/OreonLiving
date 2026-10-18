@extends('layouts.app')

@section('title', 'Page Not Found — Oreon Living')

@section('content')
<section class="section" style="min-height: 60vh; display: flex; align-items: center; justify-content: center; text-align: center;">
    <div class="container" style="max-width: 600px;">
        <span class="badge badge-accent" style="margin-bottom: 1.5rem;">404 Error</span>
        <h1 class="display" style="font-size: 2.75rem; margin-bottom: 1rem;">Form Lost to the Earth</h1>
        <p style="color: var(--color-muted); font-size: 1.1rem; line-height: 1.7; margin-bottom: 2rem;">
            The earthen vessel or page you were seeking may have been retired or reshaped. Return to our curated collections to continue your journey.
        </p>
        <div class="flex gap-2" style="justify-content: center; flex-wrap: wrap;">
            <a href="{{ route('home') }}" class="btn btn-primary">Return Home</a>
            <a href="{{ route('shop.index') }}" class="btn btn-secondary">Explore The Studio</a>
        </div>
    </div>
</section>
@endsection
