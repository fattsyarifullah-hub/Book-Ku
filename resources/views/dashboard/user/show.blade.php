@extends('layouts.dashboard')
@section('title', 'User Detail')
@section('page-title', 'User Details')

@section('content')
<div class="cr-wrapper">
    <div class="form-card" style="width: 100%; max-width: 600px; background: var(--bg-white);">
        <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 30px; border-bottom: 1px solid var(--border-light); padding-bottom: 20px;">
            <div class="profile-avatar" style="width: 64px; height: 64px; font-size: 24px; border-radius: 50%; font-weight: 700;">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div>
                <h2 style="font-size: 22px; font-weight: 700; color: var(--text-primary); margin: 0;">{{ $user->name }}</h2>
                <p style="font-size: 14px; color: var(--text-muted); margin: 4px 0 0 0;">Registered Member</p>
            </div>
        </div>

        <div class="form-group">
            <label style="font-weight: 600; color: var(--text-secondary); text-transform: uppercase; font-size: 12px; letter-spacing: 0.5px;">Full Name</label>
            <div style="padding: 12px 16px; background: var(--bg-body); border-radius: 8px; font-size: 14px; color: var(--text-primary); border: 1px solid var(--border-light);">
                {{ $user->name }}
            </div>
        </div>

        <div class="form-group">
            <label style="font-weight: 600; color: var(--text-secondary); text-transform: uppercase; font-size: 12px; letter-spacing: 0.5px;">Email Address</label>
            <div style="padding: 12px 16px; background: var(--bg-body); border-radius: 8px; font-size: 14px; color: var(--text-primary); border: 1px solid var(--border-light);">
                {{ $user->email }}
            </div>
        </div>

        <div class="form-group">
            <label style="font-weight: 600; color: var(--text-secondary); text-transform: uppercase; font-size: 12px; letter-spacing: 0.5px;">Address</label>
            <div style="padding: 12px 16px; background: var(--bg-body); border-radius: 8px; font-size: 14px; color: var(--text-primary); border: 1px solid var(--border-light); min-height: 80px; line-height: 1.5;">
                {{ $user->address ?? 'No address provided.' }}
            </div>
        </div>

        <div style="margin-top: 30px; display: flex; justify-content: flex-end;">
            <a href="{{ route('dashboard.user.index') }}" class="btn-primary" style="display: inline-flex; align-items: center; gap: 8px; text-decoration: none;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
                Back to Users
            </a>
        </div>
    </div>
</div>
@endsection
