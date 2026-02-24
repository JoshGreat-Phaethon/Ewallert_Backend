@extends('layouts.app')

@section('title', 'Masuk ke Vault')

@section('content')
<div style="
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 80vh;
    padding: var(--space-xl) 0;
">
    <div style="
        width: min(100% - var(--space-lg), 450px);
        margin: 0 auto;
    ">
        <div class="vault-card" style="
            padding: var(--space-xl);
            background: var(--vault-pure);
            border-radius: var(--border-radius-xl);
            box-shadow: 0 20px 40px -12px rgba(10,46,59,0.08);
        ">
            <div style="text-align: center; margin-bottom: var(--space-xl);">
                <i class="bi bi-shield-shaded" style="
                    font-size: var(--font-xxl);
                    color: var(--vault-gold);
                "></i>
                <h2 style="
                    font-size: var(--font-xl);
                    font-weight: 700;
                    color: var(--vault-deep);
                    margin-top: var(--space-md);
                ">Masuk ke Vault</h2>
                <p style="
                    color: #4a5c65;
                    font-size: var(--font-sm);
                    margin-top: var(--space-xs);
                ">Masukkan kredensial akun Anda</p>
            </div>
            
            <form id="loginForm">
                @csrf
                <div style="margin-bottom: var(--space-lg);">
                    <label style="
                        display: block;
                        margin-bottom: var(--space-xs);
                        font-weight: 500;
                        color: var(--vault-charcoal);
                        font-size: var(--font-sm);
                    ">Email</label>
                    <input type="email" id="email" class="form-control" 
                           value=""
                           placeholder="" 
                           required
                           style="
                        width: 100%;
                        padding: var(--space-md);
                        border: 1.5px solid var(--vault-stone);
                        border-radius: var(--border-radius-md);
                        font-size: var(--font-base);
                        transition: all 0.2s;
                    ">
                </div>
                
                <div style="margin-bottom: var(--space-lg);">
                    <label style="
                        display: block;
                        margin-bottom: var(--space-xs);
                        font-weight: 500;
                        color: var(--vault-charcoal);
                        font-size: var(--font-sm);
                    ">Password</label>
                    <input type="password" id="password" class="form-control" 
                           value="password"
                           placeholder="" 
                           required
                           style="
                        width: 100%;
                        padding: var(--space-md);
                        border: 1.5px solid var(--vault-stone);
                        border-radius: var(--border-radius-md);
                        font-size: var(--font-base);
                        transition: all 0.2s;
                    ">
                </div>
                
                <button type="submit" id="loginBtn" style="
                    width: 100%;
                    padding: var(--space-md);
                    background: var(--vault-deep);
                    color: white;
                    border: none;
                    border-radius: 100px;
                    font-weight: 600;
                    font-size: var(--font-base);
                    cursor: pointer;
                    transition: all 0.2s;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    gap: var(--space-sm);
                ">
                    <span>Masuk</span>
                    <i class="bi bi-arrow-right"></i>
                </button>
                
                <div id="message" style="margin-top: var(--space-lg); text-align: center;"></div>
            </form>
            
            <div style="
                margin-top: var(--space-xl);
                text-align: center;
                border-top: 1px solid rgba(10,46,59,0.06);
                padding-top: var(--space-lg);
            ">
                <p style="color: #4a5c65; font-size: var(--font-sm);">
                    Belum punya akun? 
                    <a href="/register" style="
                        color: var(--vault-gold);
                        font-weight: 600;
                        text-decoration: none;
                        border-bottom: 1px solid var(--vault-gold);
                        padding-bottom: 2px;
                    ">Daftar sekarang</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.getElementById('loginForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const submitBtn = document.getElementById('loginBtn');
    const messageDiv = document.getElementById('message');
    
    // Loading state
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<span>Memproses...</span> <i class="bi bi-arrow-repeat"></i>';
    submitBtn.disabled = true;
    messageDiv.innerHTML = '';
    
    try {
        // 🔴 PASTIKAN PAKAI IP BACKEND, BUKAN URL NGROK FE!
        const response = await fetch('http://10.11.111.31:8000/api/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify({
                email: email.value,
                password: password.value
            })
        });

        const data = await response.json();
        console.log('Status:', response.status);
        console.log('Data:', data);

        if (response.ok) {
            // ✅ LOGIN BERHASIL
            if (data.token) {
                localStorage.setItem('token', data.token);
                localStorage.setItem('user', JSON.stringify(data.user));
            }
            
            messageDiv.innerHTML = '<span style="color: var(--vault-teal); font-weight: 600;">✓ Login berhasil! Mengalihkan...</span>';
            
            setTimeout(() => {
                window.location.href = '/dashboard';
            }, 1500);
            
        } else {
            // ❌ LOGIN GAGAL
            const errorMsg = data.message || data.error || 'Email atau password salah';
            messageDiv.innerHTML = `<span style="color: #dc3545; font-weight: 500;">✗ ${errorMsg}</span>`;
            password.value = '';
            password.focus();
        }
        
    } catch (error) {
        console.error('Network error:', error);
        messageDiv.innerHTML = '<span style="color: #dc3545; font-weight: 500;">✗ Gagal terhubung ke server. Pastikan backend menyala.</span>';
    } finally {
        // Kembalikan tombol
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    }
});

// Auto-focus email
window.addEventListener('load', function() {
    document.getElementById('email').focus();
});
</script>
@endsection