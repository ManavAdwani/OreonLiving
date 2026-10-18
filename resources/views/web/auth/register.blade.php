@extends('layouts.app')

@section('title', 'Create Account | Oreon Living')

@section('content')
<div class="container section-tight">
    <div style="max-width: 480px; margin: 3rem auto; background-color: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-sm); padding: 2.5rem; box-shadow: var(--shadow-subtle);">
        <div style="text-align: center; margin-bottom: 2rem;">
            <span class="text-uppercase text-xs text-clay">Begin Your Ritual</span>
            <h1 style="font-size: 2rem; margin-top: 0.25rem;">Create Your Account</h1>
            <p class="text-muted" style="font-size: 0.875rem; margin-top: 0.5rem;">Join our community of natural living patrons.</p>
        </div>

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">Full Name *</label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus class="form-control" placeholder="e.g. Ananya Deshmukh">
                @error('name')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Email Address *</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="form-control" placeholder="patron@example.com">
                @error('email')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Phone Number (Optional)</label>
                <input type="tel" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="+91 98200 12345">
                @error('phone')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Password * (Minimum 8 characters)</label>
                <input type="password" name="password" required class="form-control" placeholder="••••••••">
                @error('password')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Confirm Password *</label>
                <input type="password" name="password_confirmation" required class="form-control" placeholder="••••••••">
            </div>

            <button type="submit" class="btn btn-primary btn-block btn-lg" style="margin-top: 1rem; margin-bottom: 1.5rem;">
                Create Account
            </button>
        </form>

        <div style="text-align: center; font-size: 0.875rem; color: var(--color-text-muted); border-top: 1px solid var(--color-border); padding-top: 1.5rem;">
            Already have an account? <a href="{{ route('login') }}" style="color: var(--color-clay); font-weight: 600;">Sign In</a>
        </div>
    </div>
</div>
@endsection
