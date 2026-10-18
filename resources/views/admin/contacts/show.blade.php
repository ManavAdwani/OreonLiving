@extends('layouts.admin')

@section('header_title', 'Inquiry Details')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <div class="admin-card">
        <div class="admin-card-header">
            <div>
                <h3 class="admin-card-title">Inquiry from {{ $contact->name }}</h3>
                <span style="font-size: 0.85rem; color: #888;">Received {{ $contact->created_at->format('M d, Y h:i A') }}</span>
            </div>
            <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary btn-sm">&larr; Back to Inquiries</a>
        </div>

        <div style="padding: 2rem;">
            <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                <div style="background: #fdfbf7; padding: 1.25rem; border-radius: 6px; border: 1px solid var(--admin-border);">
                    <div style="font-size: 0.8rem; text-transform: uppercase; color: #888; font-weight: 600; margin-bottom: 0.5rem;">Contact Information</div>
                    <div style="font-size: 1.1rem; font-weight: 600; margin-bottom: 0.25rem;">{{ $contact->name }}</div>
                    <div><a href="mailto:{{ $contact->email }}" style="color: var(--color-clay);">{{ $contact->email }}</a></div>
                    @if($contact->phone)
                        <div style="margin-top: 0.25rem; color: #444;">{{ $contact->phone }}</div>
                    @endif
                </div>

                <div style="background: #fdfbf7; padding: 1.25rem; border-radius: 6px; border: 1px solid var(--admin-border);">
                    <div style="font-size: 0.8rem; text-transform: uppercase; color: #888; font-weight: 600; margin-bottom: 0.5rem;">Quick Response Channels</div>
                    <div class="flex gap-1" style="flex-direction: column; margin-top: 0.5rem;">
                        @if($whatsappUrl)
                            <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener" class="btn btn-sm" style="background: #25D366; color: #fff; text-align: center;">
                                Open WhatsApp Chat &rarr;
                            </a>
                        @endif
                        <a href="mailto:{{ $contact->email }}?subject={{ urlencode('Re: ' . $contact->subject) }}" class="btn btn-secondary btn-sm" style="text-align: center;">
                            Reply via Email &rarr;
                        </a>
                    </div>
                </div>
            </div>

            <div style="margin-bottom: 2rem;">
                <div style="font-size: 0.85rem; font-weight: 600; color: #666; margin-bottom: 0.5rem;">Subject</div>
                <div style="font-size: 1.2rem; font-weight: 600; color: var(--admin-text); margin-bottom: 1rem;">{{ $contact->subject }}</div>

                <div style="font-size: 0.85rem; font-weight: 600; color: #666; margin-bottom: 0.5rem;">Customer Message</div>
                <div style="background: #f8f9fa; border: 1px solid #e9ecef; border-radius: 6px; padding: 1.25rem; font-size: 0.95rem; line-height: 1.6; white-space: pre-wrap;">{{ $contact->message }}</div>
            </div>

            <form action="{{ route('admin.contacts.status', $contact) }}" method="POST" style="background: #fdfbf7; border: 1px solid var(--admin-border); border-radius: 6px; padding: 1.5rem;">
                @csrf
                <h4 style="font-size: 1rem; margin-bottom: 1rem;">Update Inquiry Status & Notes</h4>

                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control" style="max-width: 250px;">
                        <option value="new" {{ $contact->status == 'new' ? 'selected' : '' }}>New</option>
                        <option value="in_progress" {{ $contact->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="resolved" {{ $contact->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Internal Support Notes</label>
                    <textarea name="admin_notes" rows="3" class="form-control" placeholder="Add private notes on how this inquiry was handled...">{{ old('admin_notes', $contact->admin_notes) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>
</div>
@endsection
