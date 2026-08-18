@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('page-title', 'Users Overview')

@section('content')
<div class="bm-wrapper">
    <div class="bm-card">
        <div class="bm-table-wrapper">
            <table class="bm-table">
                <thead>
                    <th class="bm-th">Nama</th>
                    <th class="bm-th">Email</th>
                    <th class="bm-th">Nomor Telepon</th>
                    <th class="bm-th">Alamat</th>
                    <th class="bm-th">Role</th>
                    <th class="bm-th">Action</th>
                </thead>
                <tbody>
                    @foreach ($alluser as $user)
                    <tr class="bm-tr" data-search="{{ strtolower($user->name . ' ' . $user->email . ' ' . ($user->phone_number ?? '')) }}">
                        <td class="bm-td">
                            <h3>{{$user->name}}</h3>
                        </td>
                        <td class="bm-td">
                            <a href="mailto:{{$user->email}}"><p>{{$user->email}}</p></a>
                        </td>
                        <td class="bm-td">
                            <a href="telto: {{$user->phone_number}}"><p>{{$user->phone_number}}</p></a>
                        </td>
                        <td class="bm-td">
                            <p>{{$user->address}}</p>
                        </td>
                        <td class="bm-td">
                            <form action="{{ route('dashboard.user.updateRole', $user->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="role" class="select-action" id="" onchange="this.form.submit()">
                                    <option value="admin" {{ strtolower($user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="customer" {{ strtolower($user->role) === 'customer' ? 'selected' : '' }}>Customer</option>
                                </select>
                            </form>
                        </td>
                        <td class="bm-td">
                            <a class="bm-action-btn bm-action-view" href="{{ route('dashboard.user.show', $user->id) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>    

@endsection
