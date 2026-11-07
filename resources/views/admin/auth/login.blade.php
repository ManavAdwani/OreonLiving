<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Sign In | Oréon Living Administration</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/oreon.css') }}">
    <style>
        body {
            background-color: #171513;
            color: #FAF7F2;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 1.5rem;
        }
        .login-card {
            background: #24201D;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 3rem 2.5rem;
            max-width: 440px;
            width: 100%;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
        }
        .login-card .form-control {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #FFFFFF;
        }
        .login-card .form-control:focus {
            border-color: var(--color-clay);
        }
        .login-card .form-label {
            color: #D6D3D1;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div style="text-align: center; margin-bottom: 2rem;">
            <span style="font-family: 'Cormorant Garamond', serif; font-size: 2rem; font-weight: 600; color: #FAF7F2; display: block;">ORÉON LIVING</span>
            <span style="font-size: 0.75rem; letter-spacing: 0.15em; text-transform: uppercase; color: var(--color-clay); font-weight: 600;">Staff &amp; Operations Portal</span>
        </div>

        @if(session('error'))
            <div class="alert alert-danger" style="margin-bottom: 1.5rem;">
                {{ session('error') }}
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success" style="margin-bottom: 1.5rem;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">Staff Email Address *</label>
                <input type="email" name="email" value="{{ old('email', 'admin@oreonliving.com') }}" required autofocus class="form-control" placeholder="staff@oreonliving.com">
                @error('email')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Password *</label>
                <input type="password" name="password" required value="Password@123" class="form-control" placeholder="••••••••">
                @error('password')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div style="margin-bottom: 1.5rem; font-size: 0.8125rem;">
                <label style="display: flex; align-items: center; gap: 0.4rem; cursor: pointer; color: #A8A29E;">
                    <input type="checkbox" name="remember" checked>
                    <span>Remember staff session</span>
                </label>
            </div>

            <button type="submit" class="btn btn-primary btn-block btn-lg" style="margin-bottom: 1.5rem;">
                Authenticate to Staff Console
            </button>
        </form>

        <div style="background: rgba(255,255,255,0.04); border: 1px dashed rgba(255,255,255,0.15); border-radius: 4px; padding: 1rem; font-size: 0.75rem; color: #A8A29E;">
            <strong>Demo Credentials (from Seeder):</strong><br>
            Super Admin: admin@oreonliving.com<br>
            Product Mgr: products@oreonliving.com<br>
            Order Mgr: orders@oreonliving.com<br>
            Password: <code>Password@123</code>
        </div>
    </div>
</body>
</html>
