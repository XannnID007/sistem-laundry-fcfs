<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Laundry System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#6861CE',
                        secondary: '#5C55BF',
                        accent: '#9B59B6',
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-size: 14px;
            /* Gabungan Lapisan Ungu (Opacity 70%-85%) dan Gambar Background */
            background-image:
                linear-gradient(135deg, rgba(176, 172, 228, 0.623) 0%, rgba(75, 35, 121, 0.85) 100%),
                url('img/bg.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }



        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .slide-in {
            animation: slideIn 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            position: relative;
            z-index: 10;
        }

        /* Efek Shadow Premium untuk Kartu Login */
        .login-card {
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>

<body class="min-h-screen flex flex-col items-center justify-center p-4 relative">

    <div class="bg-overlay"></div>

    <div class="w-full max-w-5xl slide-in">
        <div class="bg-white rounded-3xl overflow-hidden login-card flex flex-col md:flex-row">

            <div class="w-full md:w-1/2 p-10 md:p-14 bg-white">
                <div class="mb-10 text-center">
                    <div class="inline-block p-3 rounded-full bg-primary/10 mb-4 text-primary">
                        <i class="fas fa-tshirt fa-2x"></i>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2 tracking-wide">SELAMAT DATANG</h1>
                    <div class="w-16 h-1.5 bg-gradient-to-r from-primary to-accent rounded-full mx-auto"></div>
                    <p class="text-gray-500 text-sm mt-3">Silakan login untuk mengakses sistem</p>
                </div>

                @if ($errors->any())
                    <div
                        class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-lg text-sm flex items-start shadow-sm">
                        <i class="fas fa-exclamation-circle text-red-500 mt-0.5 mr-2"></i>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('login.post') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="username" class="block text-gray-700 font-semibold mb-2 text-sm">Username</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input type="text" name="username" id="username" required
                                class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none transition text-gray-700 font-medium"
                                value="{{ old('username') }}" placeholder="Masukkan username Anda">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-gray-700 font-semibold mb-2 text-sm">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input type="password" name="password" id="password" required
                                class="w-full pl-11 pr-12 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none transition text-gray-700 font-medium"
                                placeholder="••••••••">
                            <button type="button" onclick="togglePassword()"
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-primary transition">
                                <i id="eye-icon" class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-gradient-to-r from-primary to-secondary hover:from-secondary hover:to-primary text-white font-bold py-3.5 rounded-xl transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 mt-4">
                        <i class="fas fa-sign-in-alt mr-2"></i> MASUK
                    </button>

                </form>
            </div>

            <div
                class="hidden md:flex w-full md:w-1/2 bg-gray-50 items-center justify-center p-10 relative overflow-hidden bg-gradient-to-br from-gray-50 to-gray-100">
                <div
                    class="absolute top-[-50px] right-[-50px] w-64 h-64 bg-primary rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob">
                </div>
                <div
                    class="absolute bottom-[-50px] left-[-50px] w-64 h-64 bg-accent rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob animation-delay-2000">
                </div>

                <div class="text-center z-10 w-full max-w-sm">
                    <h2 class="text-5xl font-bold mb-2 text-primary" style="font-family: 'Brush Script MT', cursive;">
                        RedDoorz Laundry
                    </h2>
                    <p class="text-gray-500 font-medium mb-10">Wash & Care Management</p>

                    <div class="relative flex justify-center">
                        <div class="relative w-72 h-60">
                            <img src="img/bg.jpg" alt="Laundry Illustration"
                                class="w-full h-full object-cover rounded-lg shadow-lg">
                        </div>
                    </div>

                    <div class="mt-8 flex justify-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-primary opacity-80"></div>
                        <div class="w-3 h-3 rounded-full bg-secondary opacity-60"></div>
                        <div class="w-3 h-3 rounded-full bg-accent opacity-40"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <p class="text-center text-white text-sm mt-8 relative z-10 font-medium tracking-wide">
        © {{ date('Y') }} RedDoorz Laundry System. All rights reserved.
    </p>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>
