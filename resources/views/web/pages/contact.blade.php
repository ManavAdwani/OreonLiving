@extends('layouts.app')

@section('title', 'Contact Studio Concierge | Oreon Living')

@section('content')
<div class="container section-tight">
    <!-- Breadcrumb -->
    <nav class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="breadcrumb-separator">/</span>
        <span>Contact Concierge</span>
    </nav>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: start; margin-bottom: 5rem;" class="contact-grid">
        <!-- Left: Contact Information -->
        <div>
            <span class="text-uppercase text-xs text-clay">Get in Touch</span>
            <h1 style="font-size: clamp(2.2rem, 4vw, 3.2rem); margin: 0.5rem 0 1.25rem;">We Welcome Your Reflections</h1>
            <p class="lead-text" style="margin-bottom: 2rem;">
                Whether you have questions regarding clay seasoning, custom architectural planter orders, or transit tracking, our concierge team is at your service.
            </p>

            <div style="display: flex; flex-direction: column; gap: 1.5rem; margin-bottom: 2.5rem;">
                <div>
                    <h4 style="font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--color-text-muted); margin-bottom: 0.25rem;">Studio Address</h4>
                    <p style="font-size: 0.9375rem; color: var(--color-text);">{{ $settings['address'] }}</p>
                </div>

                <div>
                    <h4 style="font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--color-text-muted); margin-bottom: 0.25rem;">Concierge Email</h4>
                    <p style="font-size: 0.9375rem;"><a href="mailto:{{ $settings['email'] }}" style="color: var(--color-clay); text-decoration: underline;">{{ $settings['email'] }}</a></p>
                </div>

                <div>
                    <h4 style="font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--color-text-muted); margin-bottom: 0.25rem;">Telephone</h4>
                    <p style="font-size: 0.9375rem; color: var(--color-text);">{{ $settings['phone'] }} (Mon &ndash; Sat, 10 AM &ndash; 7 PM IST)</p>
                </div>
            </div>

            <!-- Instant WhatsApp Chat Link -->
            <a href="https://wa.me/{{ $settings['whatsapp'] }}?text={{ urlencode('Hello Oreon Living, I would like to speak with your studio concierge.') }}" 
               target="_blank" rel="noopener noreferrer" 
               class="btn" style="background-color: #25D366; color: #FFFFFF; display: inline-flex;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="#FFFFFF"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0 0 12.04 2z"></path></svg>
                <span>Live Chat on WhatsApp</span>
            </a>
        </div>

        <!-- Right: Inquiry Form -->
        <div style="background-color: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-sm); padding: clamp(1.5rem, 4vw, 2.5rem); box-shadow: var(--shadow-subtle);">
            <h3 style="font-size: 1.35rem; margin-bottom: 1.25rem;">Send a Message</h3>
            
            <form action="{{ route('pages.contact.submit') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label class="form-label">Full Name *</label>
                    <input type="text" name="name" required value="{{ old('name') }}" class="form-control" placeholder="Your name">
                </div>

                <div class="form-group">
                    <label class="form-label">Email Address *</label>
                    <input type="email" name="email" required value="{{ old('email') }}" class="form-control" placeholder="patron@example.com">
                </div>

                <div class="form-group">
                    <label class="form-label">Phone Number (Optional)</label>
                    <input type="tel" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="+91 98200 12345">
                </div>

                <div class="form-group">
                    <label class="form-label">Inquiry Subject</label>
                    <input type="text" name="subject" value="{{ old('subject') }}" class="form-control" placeholder="e.g. Care query, Order tracking, or Custom piece">
                </div>

                <div class="form-group">
                    <label class="form-label">Your Message *</label>
                    <textarea name="message" rows="4" required class="form-control" placeholder="How may we assist you?">{{ old('message') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-lg" style="margin-top: 1rem;">
                    Dispatch Message
                </button>
            </form>
        </div>
    </div>
</div>

<style>
@media (max-width: 860px) {
    .contact-grid {
        grid-template-columns: 1fr !important;
        gap: 2.5rem !important;
    }
}
</style>
@endsection
