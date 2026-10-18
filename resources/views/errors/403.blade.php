@extends('layouts.app')

@section('title', 'Access Restricted — Oreon Living')

@section('content')
<section class="section" style="min-height: 60vh; display: flex; align-items: center; justify-content: center; text-align: center;">
    <div class="container" style="max-width: 600px;">
        <span class="badge badge-accent" style="margin-bottom: 1.5rem;">403 Forbidden</span>
        <h1 class="display" style="font-size: 2.75rem; margin-bottom: 1rem;">Sanctum Restricted</h1>
        <p style="color: var(--color-muted); font-size: 1.1rem; line-height: 1.7; margin-bottom: 2rem;">
            You do not possess the necessary staff authorizations or permissions to access this studio workshop panel.
        </p>
        <div class="flex gap-2" style="justify-content: center; flex-wrap: wrap;">
            <a href="{{ route('home') }}" class="btn btn-primary">Return to Storefront</a>
            @auth
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Admin Dashboard</a>
            @endauth
        </div>
    </div>
</section>
@endsection
