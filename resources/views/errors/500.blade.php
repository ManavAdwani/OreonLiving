@extends('layouts.app')

@section('title', 'Server Error — Oreon Living')

@section('content')
<section class="section" style="min-height: 60vh; display: flex; align-items: center; justify-content: center; text-align: center;">
    <div class="container" style="max-width: 600px;">
        <span class="badge badge-accent" style="margin-bottom: 1.5rem;">500 Internal Error</span>
        <h1 class="display" style="font-size: 2.75rem; margin-bottom: 1rem;">The Wheel Paused</h1>
        <p style="color: var(--color-muted); font-size: 1.1rem; line-height: 1.7; margin-bottom: 2rem;">
            An unexpected glitch occurred in our kiln. Our craft engineers have been alerted and are resolving the matter.
        </p>
        <div class="flex gap-2" style="justify-content: center; flex-wrap: wrap;">
            <a href="{{ route('home') }}" class="btn btn-primary">Return Home</a>
            <a href="{{ route('pages.contact') }}" class="btn btn-secondary">Report Issue</a>
        </div>
    </div>
</section>
@endsection
