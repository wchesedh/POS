<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>Login | {{ config('app.name') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('images/favicon.png') }}">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
        }

        .brand-section {
            text-align: center;
            margin-bottom: 2rem;
        }

        .brand-logo {
            font-size: 2.5rem;
            font-weight: 800;
            color: #1a1a1a;
            letter-spacing: -0.02em;
            margin-bottom: 0.5rem;
        }

        .brand-logo .pos-text {
            color: #3b82f6;
        }

        .brand-subtitle {
            font-size: 0.875rem;
            color: #64748b;
            font-weight: 500;
            letter-spacing: 0.05em;
        }

        .login-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .login-header {
            margin-bottom: 2rem;
        }

        .login-header h1 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
        }

        .login-header p {
            color: #64748b;
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 0.5rem;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 1.125rem;
        }

        .form-input {
            width: 100%;
            padding: 0.875rem 1rem 0.875rem 3rem;
            font-size: 0.95rem;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            background: #f8fafc;
            color: #1a1a1a;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
        }

        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            background: #ffffff;
        }

        .form-input.is-invalid {
            border-color: #ef4444;
            background: #fef2f2;
        }

        .invalid-feedback {
            color: #ef4444;
            font-size: 0.8rem;
            margin-top: 0.375rem;
            display: block;
        }

        .forgot-password {
            text-align: right;
            margin-bottom: 1.5rem;
        }

        .forgot-password a {
            color: #3b82f6;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: color 0.2s;
        }

        .forgot-password a:hover {
            color: #2563eb;
        }

        .btn-login {
            width: 100%;
            padding: 0.875rem;
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            color: #ffffff;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .spinner {
            width: 18px;
            height: 18px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .alert {
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
        }

        .alert-danger {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 2rem 1.5rem;
            }

            .brand-logo {
                font-size: 2rem;
            }

            .login-header h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
<div class="login-container">
    <!-- Brand Section -->
    <div class="brand-section">
        <div class="brand-logo">KABSAT <span class="pos-text">POS</span></div>
        <div class="brand-subtitle">Point of Sale System</div>
    </div>

    <!-- Login Card -->
    <div class="login-card">
        @if(Session::has('account_deactivated'))
            <div class="alert alert-danger">
                {{ Session::get('account_deactivated') }}
            </div>
        @endif

        <div class="login-header">
            <h1>Welcome Back</h1>
            <p>Sign in to continue to your dashboard</p>
        </div>

        <form id="login" method="post" action="{{ url('/login') }}">
            @csrf

            <!-- Email Field -->
            <div class="form-group">
                <label class="form-label" for="email">Email Address</label>
                <div class="input-wrapper">
                    <i class="bi bi-envelope input-icon"></i>
                    <input 
                        id="email" 
                        type="email" 
                        class="form-input @error('email') is-invalid @enderror"
                        name="email" 
                        value="{{ old('email') }}"
                        placeholder="Enter your email"
                        required>
                </div>
                @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <div class="input-wrapper">
                    <i class="bi bi-lock input-icon"></i>
                    <input 
                        id="password" 
                        type="password"
                        class="form-input @error('password') is-invalid @enderror"
                        name="password"
                        placeholder="Enter your password"
                        required>
                </div>
                @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Forgot Password Link -->
            <div class="forgot-password">
                <a href="{{ route('password.request') }}">Forgot password?</a>
            </div>

            <!-- Login Button -->
            <button id="submit" class="btn-login" type="submit">
                <span>Sign In</span>
                <div id="spinner" class="spinner" style="display: none;"></div>
            </button>
        </form>
    </div>
</div>
<script>
    const loginForm = document.getElementById('login');
    const submitBtn = document.getElementById('submit');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const spinner = document.getElementById('spinner');

    loginForm.addEventListener('submit', (e) => {
        submitBtn.disabled = true;
        emailInput.readOnly = true;
        passwordInput.readOnly = true;
        
        // Show spinner
        spinner.style.display = 'block';
        submitBtn.querySelector('span').style.display = 'none';
    });

    // Re-enable after timeout (safety fallback)
    setTimeout(() => {
        submitBtn.disabled = false;
        emailInput.readOnly = false;
        passwordInput.readOnly = false;
        spinner.style.display = 'none';
        submitBtn.querySelector('span').style.display = 'block';
    }, 5000);
</script>

</body>
</html>
