@extends('layouts.app')

@section('title', 'Sign In | Oreon Living')

@section('content')
<div class="container section-tight">
    <div style="max-width: 440px; margin: 3rem auto; background-color: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-sm); padding: 2.5rem; box-shadow: var(--shadow-subtle);">
        <div style="text-align: center; margin-bottom: 2rem;">
            <span class="text-uppercase text-xs text-clay">Welcome Back</span>
            <h1 style="font-size: 2rem; margin-top: 0.25rem;">Sign In to Your Account</h1>
            <p class="text-muted" style="font-size: 0.875rem; margin-top: 0.5rem;">Access your orders, saved addresses &amp; wishlist.</p>
        </div>

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">Email Address *</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control" placeholder="patron@example.com">
                @error('email')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Password *</label>
                <input type="password" name="password" required class="form-control" placeholder="••••••••">
                @error('password')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-between items-center" style="margin-bottom: 1.5rem; font-size: 0.8125rem;">
                <label style="display: flex; align-items: center; gap: 0.4rem; cursor: pointer;">
                    <input type="checkbox" name="remember">
                    <span>Keep me signed in</span>
                </label>
            </div>

            <button type="submit" class="btn btn-primary btn-block btn-lg" style="margin-bottom: 1.5rem;">
                Sign In
            </button>
        </form>

        <div style="text-align: center; font-size: 0.875rem; color: var(--color-text-muted); border-top: 1px solid var(--color-border); padding-top: 1.5rem;">
            New to Oreon Living? <a href="{{ route('register') }}" style="color: var(--color-clay); font-weight: 600;">Create an Account</a>
        </div>
    </div>
</div>
@endsection
