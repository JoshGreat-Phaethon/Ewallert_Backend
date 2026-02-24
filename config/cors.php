<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'],
    
    'allowed_methods' => ['*'],
    
    // ⚠️ GANTI INI dengan alamat React kamu!
    'allowed_origins' => [
        'http://localhost:3000',  // React default
        'http://localhost:5173',  // Vite default (React modern)
        'http://192.168.1.x:3000', // Kalau pake IP (beda jaringan)
    ],
    
    'allowed_origins_patterns' => [],
    
    'allowed_headers' => ['*'],
    
    'exposed_headers' => [],
    
    'max_age' => 0,
    
    'supports_credentials' => false, // true kalau pake cookie/session
];