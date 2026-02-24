@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="card shadow">
    <div class="card-body">
        <h4>Dashboard</h4>
        <hr>

        <p>Nama: <span id="name"></span></p>
        <p>Saldo: Rp <span id="saldo"></span></p>

        <a href="/topup" class="btn btn-success">Top Up</a>
        <button id="logoutBtn" class="btn btn-danger">Logout</button>
        <a href="/" class="btn btn-success">back</a>
    </div>
</div>
@endsection

@section('scripts')
<script>
async function loadUser(){
    const token = localStorage.getItem('token');

    if(!token){
        window.location.href = '/login';
        return;
    }

    const response = await fetch('/api/me', {
        headers: {
            'Authorization': 'Bearer ' + token
        }
    });

    if(!response.ok){
        localStorage.removeItem('token');
        window.location.href = '/login';
        return;
    }

    const user = await response.json();

    document.getElementById('name').innerText = user.name;
    document.getElementById('saldo').innerText = user.saldo ?? 0;
}

document.getElementById('logoutBtn').addEventListener('click', async function(){
    const token = localStorage.getItem('token');

    await fetch('/api/logout', {
        method: 'POST',
        headers: {
            'Authorization': 'Bearer ' + token
        }
    });

    localStorage.removeItem('token');
    window.location.href = '/login';
});

loadUser();
</script>
@endsection
