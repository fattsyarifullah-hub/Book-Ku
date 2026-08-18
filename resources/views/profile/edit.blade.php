@extends('layouts.dashboard')
@section('title', 'Profile')
@section('page-title', 'Profile Settings')

@section('content')
<div class="content" style="padding-top: 10px;">
    <div style="display: grid; grid-template-columns: 1fr; gap: 32px; max-width: 800px; margin: 0 auto;">
        
        <!-- Profile Info Card -->
        <div class="card" style="padding: 32px; border-radius: 16px; background: var(--bg-white);">
            <h3 class="card-title" style="font-size: 18px; border-bottom: 1px solid var(--border-light); padding-bottom: 12px; margin-bottom: 24px; font-weight: 700;">Update Profile Information</h3>
            <div class="form-wrapper">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Password Card -->
        <div class="card" style="padding: 32px; border-radius: 16px; background: var(--bg-white);">
            <h3 class="card-title" style="font-size: 18px; border-bottom: 1px solid var(--border-light); padding-bottom: 12px; margin-bottom: 24px; font-weight: 700;">Update Password</h3>
            <div class="form-wrapper">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Delete Account Card -->
        <div class="card" style="padding: 32px; border-radius: 16px; border-color: var(--danger); background: var(--bg-white);">
            <h3 class="card-title" style="font-size: 18px; color: var(--danger); border-bottom: 1px solid var(--danger-bg); padding-bottom: 12px; margin-bottom: 24px; font-weight: 700;">Delete Account</h3>
            <div class="form-wrapper">
                @include('profile.partials.delete-user-form')
            </div>
        </div>

    </div>
</div>

<style>
    /* Styling form inputs inside dashboard profile to match dashboard look */
    .form-wrapper label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        font-size: 13px;
        color: var(--text-secondary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .form-wrapper input {
        width: 100%;
        padding: 12px 16px;
        border-radius: 10px;
        border: 1px solid var(--border);
        background: var(--bg-body);
        color: var(--text-primary);
        outline: none;
        font-family: inherit;
        font-size: 14px;
        transition: all 0.2s ease-in-out;
        box-sizing: border-box;
        margin-bottom: 16px;
    }
    .form-wrapper input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-light);
        background: #ffffff;
    }
    .form-wrapper button {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border: none;
        background: var(--primary);
        color: white;
        padding: 12px 24px;
        border-radius: 10px;
        cursor: pointer;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.2s ease-in-out;
    }
    .form-wrapper button:hover {
        background: var(--primary-hover);
        transform: translateY(-2px);
    }
    .form-wrapper section {
        margin: 0;
    }
    .form-wrapper header {
        margin-bottom: 24px;
    }
    .form-wrapper h2 {
        font-size: 16px;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0 0 6px 0;
    }
    .form-wrapper p {
        font-size: 13px;
        color: var(--text-muted);
        margin: 0;
    }
</style>
@endsection
