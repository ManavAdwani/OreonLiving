@extends('layouts.app')

@section('title', 'Frequently Asked Questions | Oréon Living')
@section('meta_description', 'Everything you need to know about caring for terracotta, seasoning clay cookware, and transit guarantee.')

@section('content')
<div class="container section-tight">
    <!-- Breadcrumb -->
    <nav class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="breadcrumb-separator">/</span>
        <span>FAQ</span>
    </nav>

    <div style="max-width: 800px; margin: 0 auto 5rem;">
        <div style="text-align: center; margin-bottom: 3.5rem;">
            <span class="text-uppercase text-xs text-clay">Help &amp; Insights</span>
            <h1 style="font-size: clamp(2.2rem, 4vw, 3.2rem); margin: 0.5rem 0 1rem;">Frequently Asked Questions</h1>
            <p class="lead-text">Everything you need to know about welcoming, seasoning, and caring for natural terracotta in your home.</p>
        </div>

        @foreach($faqs as $categoryName => $faqList)
            <div style="margin-bottom: 3rem;">
                <h2 style="font-size: 1.5rem; margin-bottom: 1.25rem; border-bottom: 1.5px solid var(--color-border); padding-bottom: 0.5rem; color: var(--color-clay);">
                    {{ $categoryName }}
                </h2>

                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    @foreach($faqList as $faq)
                        <details style="background: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-sm); padding: 1.25rem 1.5rem;">
                            <summary style="font-family: var(--font-display); font-size: 1.25rem; font-weight: 600; cursor: pointer; color: var(--color-text);">
                                {{ $faq->question }}
                            </summary>
                            <div style="margin-top: 0.85rem; color: var(--color-text-muted); line-height: 1.8; font-size: 0.9375rem; border-top: 1px solid var(--color-border-subtle); padding-top: 0.75rem;">
                                {{ $faq->answer }}
                            </div>
                        </details>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div style="background-color: var(--color-surface-subtle); border: 1px solid var(--color-border); border-radius: var(--radius-sm); padding: 2.5rem; text-align: center; margin-top: 4rem;">
            <h3 style="font-size: 1.35rem; margin-bottom: 0.5rem;">Still have a question?</h3>
            <p class="text-muted" style="margin-bottom: 1.5rem;">Our studio concierge is always delighted to assist you with pottery care advice.</p>
            <div class="flex justify-center gap-2">
                <a href="{{ route('pages.contact') }}" class="btn btn-secondary">Contact Studio</a>
                <a href="https://wa.me/{{ \App\Models\WebsiteSetting::get('whatsapp_number', '919876543210') }}" target="_blank" class="btn btn-dark">Chat on WhatsApp</a>
            </div>
        </div>
    </div>
</div>
@endsection
