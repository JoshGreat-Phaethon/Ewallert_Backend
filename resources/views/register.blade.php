@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-body">
                <h4 class="mb-4 text-center">Register</h4>

                <form id="registerForm">
                    <div class="mb-3">
                        <input type="text" id="name" class="form-control" placeholder="Nama" required>
                    </div>

                    <div class="mb-3">
                        <input type="email" id="email" class="form-control" placeholder="Email" required>
                    </div>

                    <div class="mb-3">
                        <input type="password" id="password" class="form-control" placeholder="Password" required>
                    </div>

                    <div class="mb-3">
                        <input type="password" id="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Register</button>
                </form>
                
                <div class="mt-3 text-center">
                    <a href="/login">Sudah punya akun? Login</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.getElementById('registerForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    // ✅ AMBIL ELEMENT INPUT DENGAN ID
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const passwordConfirmationInput = document.getElementById('password_confirmation');
    
    // ✅ CEK PASSWORD MATCH
    if (passwordInput.value !== passwordConfirmationInput.value) {
        alert('Password dan konfirmasi password tidak cocok!');
        return;
    }
    
    // ✅ TAMPILKAN LOADING
    const submitBtn = e.target.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerText;
    submitBtn.innerText = 'Loading...';
    submitBtn.disabled = true;
    
    try {
        const response = await fetch('/api/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify({
                name: nameInput.value,
                email: emailInput.value,
                password: passwordInput.value,
                password_confirmation: passwordConfirmationInput.value
            })
        });

        const data = await response.json();
        
        if (response.ok) {
            // ✅ SIMPAN TOKEN KALAU ADA
            if (data.token) {
                localStorage.setItem('token', data.token);
            }
            alert('Registrasi berhasil!');
            window.location.href = '/login';
        } else {
            // ✅ TAMPILKAN ERROR DETAIL DARI SERVER
            const errorMsg = data.message || 'Register gagal';
            if (data.errors) {
                const errors = Object.values(data.errors).flat().join('\n');
                alert(errorMsg + ':\n' + errors);
            } else {
                alert(errorMsg);
            }
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan jaringan. Coba lagi.');
    } finally {
        // ✅ KEMBALIKAN TOMBOL
        submitBtn.innerText = originalText;
        submitBtn.disabled = false;
    }
});
</script>
@endsection

{{-- ✅ TAMBAHKAN CSRF META DI LAYOUT --}}
{{-- Pastikan di layouts/app.blade.php ada: --}}
{{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}