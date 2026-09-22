<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Antrean ULT BBPMP Sulsel - Redesign HUD & Admin Portal</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts: Inter & JetBrains Mono -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;600;700&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        bbpmp: {
                            50: '#eef8ff',
                            100: '#d8f0ff',
                            500: '#00a8ff',
                            600: '#0083db',
                            800: '#0c2340',
                            900: '#061325',
                            dark: '#030a16'
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace'],
                    },
                    animation: {
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'glow': 'glow 3s ease-in-out infinite alternate',
                        'marquee': 'marquee 25s linear infinite',
                    },
                    keyframes: {
                        glow: {
                            '0%': { opacity: '0.4', filter: 'drop-shadow(0 0 15px rgba(56, 189, 248, 0.4))' },
                            '100%': { opacity: '0.8', filter: 'drop-shadow(0 0 30px rgba(56, 189, 248, 0.8))' }
                        },
                        marquee: {
                            '0%': { transform: 'translateX(100%)' },
                            '100%': { transform: 'translateX(-100%)' }
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body {
            background: linear-gradient(135deg, #020b18 0%, #08203e 50%, #0b325c 100%);
            color: #f1f5f9;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #061325;
        }
        ::-webkit-scrollbar-thumb {
            background: #1e3a8a;
            border-radius: 4px;
        }

        /* Ambient Corner Glow Backgrounds */
        .ambient-glow-tl {
            position: absolute;
            top: -120px;
            left: -120px;
            width: 380px;
            height: 380px;
            background: radial-gradient(circle, rgba(14, 165, 233, 0.22) 0%, rgba(3, 10, 22, 0) 70%);
            pointer-events: none;
            z-index: 0;
        }

        .ambient-glow-tr {
            position: absolute;
            top: -100px;
            right: -100px;
            width: 420px;
            height: 420px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.2) 0%, rgba(3, 10, 22, 0) 70%);
            pointer-events: none;
            z-index: 0;
        }

        /* Geometric Dot Grid Accent */
        .dot-grid-pattern {
            background-image: radial-gradient(rgba(56, 189, 248, 0.18) 1px, transparent 1px);
            background-size: 16px 16px;
        }

        /* Futuristic HUD Corner Lines */
        .corner-hud-tl {
            position: absolute;
            top: 12px;
            left: 12px;
            width: 26px;
            height: 26px;
            border-top: 2px solid rgba(56, 189, 248, 0.6);
            border-left: 2px solid rgba(56, 189, 248, 0.6);
            border-top-left-radius: 6px;
            pointer-events: none;
        }
        .corner-hud-tr {
            position: absolute;
            top: 12px;
            right: 12px;
            width: 26px;
            height: 26px;
            border-top: 2px solid rgba(56, 189, 248, 0.6);
            border-right: 2px solid rgba(56, 189, 248, 0.6);
            border-top-right-radius: 6px;
            pointer-events: none;
        }
        .corner-hud-bl {
            position: absolute;
            bottom: 12px;
            left: 12px;
            width: 26px;
            height: 26px;
            border-bottom: 2px solid rgba(56, 189, 248, 0.6);
            border-left: 2px solid rgba(56, 189, 248, 0.6);
            border-bottom-left-radius: 6px;
            pointer-events: none;
        }
        .corner-hud-br {
            position: absolute;
            bottom: 12px;
            right: 12px;
            width: 26px;
            height: 26px;
            border-bottom: 2px solid rgba(56, 189, 248, 0.6);
            border-right: 2px solid rgba(56, 189, 248, 0.6);
            border-bottom-right-radius: 6px;
            pointer-events: none;
        }

        /* Glassmorphism Panels */
        .glass-card {
            background: rgba(13, 38, 68, 0.45);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(56, 189, 248, 0.18);
            box-shadow: 0 12px 35px 0 rgba(0, 0, 0, 0.35);
        }

        .glass-card-glow {
            background: rgba(10, 26, 48, 0.75);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(56, 189, 248, 0.35);
            box-shadow: 0 0 30px rgba(0, 168, 255, 0.18);
        }

        /* Pulse Dot Animation */
        .pulse-dot {
            width: 8px;
            height: 8px;
            background-color: #34d399;
            border-radius: 50%;
            box-shadow: 0 0 10px #34d399;
            animation: pulse-dot-anim 2s infinite;
        }
        @keyframes pulse-dot-anim {
            0% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(1.2); }
            100% { opacity: 1; transform: scale(1); }
        }

        /* Custom Range Slider */
        input[type=range] {
            -webkit-appearance: none;
            width: 100%;
            height: 8px;
            background: rgba(255, 255, 255, 0.12);
            border-radius: 10px;
            outline: none;
        }
        input[type=range]::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: linear-gradient(135deg, #38bdf8, #2563eb);
            cursor: pointer;
            border: 2px solid #ffffff;
            box-shadow: 0 0 10px rgba(56, 189, 248, 0.5);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col md:flex-row overflow-x-hidden relative selection:bg-cyan-500 selection:text-black">

    <div class="ambient-glow-tl"></div>
    <div class="ambient-glow-tr"></div>

    <!-- Mobile Navigation Toggle Button -->
    <button onclick="toggleMobileSidebar()" class="md:hidden fixed top-4 left-4 z-50 p-2.5 rounded-xl bg-slate-900/85 border border-cyan-400/40 text-cyan-300 backdrop-blur-md shadow-lg hover:border-cyan-300 transition-all">
        <i class="fa-solid fa-bars text-lg"></i>
    </button>
    <div id="sidebar-overlay" onclick="toggleMobileSidebar()" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-30 md:hidden"></div>

    <aside id="sidebar-menu" class="fixed md:static inset-y-0 left-0 w-72 bg-[#041226]/80 backdrop-blur-2xl border-r border-cyan-500/20 flex flex-col justify-between z-40 flex-shrink-0 transition-transform duration-300 -translate-x-full md:translate-x-0 shadow-[12px_0_35px_rgba(0,0,0,0.4)]">
        
        <!-- Sidebar Gradient Header Accent Line -->
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-cyan-400 via-blue-500 to-indigo-500"></div>

        <div>
            <!-- Sidebar Brand Section -->
            <div class="p-5 border-b border-white/10 flex items-center gap-3.5">
                <div class="w-11 h-11 rounded-2xl bg-cyan-500/15 border border-cyan-400/30 flex items-center justify-center text-cyan-400 text-xl font-bold shadow-lg shadow-cyan-950/50">
                    <i class="fa-solid fa-shield-halved animate-pulse"></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-base font-extrabold tracking-wide bg-gradient-to-r from-white via-slate-100 to-blue-400 bg-clip-text text-transparent">
                        BBPMP SULSEL
                    </span>
                    <small class="text-[11px] font-semibold text-slate-400">Admin Portal & System ULT</small>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="p-3 space-y-2 mt-2">
                
                <!-- Nav Item 1: Home -->
                <button onclick="switchTab('home')" id="nav-home" class="nav-btn w-full flex items-center justify-between px-4 py-3.5 rounded-2xl text-sm font-semibold transition-all bg-gradient-to-r from-cyan-500/35 to-blue-600/45 text-white border border-cyan-300/50 shadow-[0_8px_20px_rgba(14,165,233,0.25)]">
                    <div class="flex items-center gap-3.5">
                        <span class="text-lg w-6 text-center text-cyan-300"><i class="fa-solid fa-house-laptop"></i></span>
                        <span class="nav-label">Home Dashboard</span>
                    </div>
                    <span class="text-[10px] bg-white/15 text-cyan-200 px-2.5 py-0.5 rounded-full font-mono border border-white/10">Main</span>
                </button>

                <!-- Nav Item 2: Layar Display TV -->
                <button onclick="switchTab('display')" id="nav-display" class="nav-btn w-full flex items-center justify-between px-4 py-3.5 rounded-2xl text-sm font-semibold text-slate-400 hover:text-white hover:bg-white/5 transition-all border border-transparent">
                    <div class="flex items-center gap-3.5">
                        <span class="text-lg w-6 text-center text-sky-400"><i class="fa-solid fa-tv"></i></span>
                        <span class="nav-label">Layar Display TV</span>
                    </div>
                    <span class="text-[10px] bg-sky-500/20 text-sky-300 border border-sky-500/30 px-2 py-0.5 rounded-full font-mono">Monitor</span>
                </button>

                <!-- Nav Item 3: Cetak Tiket -->
                <button onclick="switchTab('tiket')" id="nav-tiket" class="nav-btn w-full flex items-center justify-between px-4 py-3.5 rounded-2xl text-sm font-semibold text-slate-400 hover:text-white hover:bg-white/5 transition-all border border-transparent">
                    <div class="flex items-center gap-3.5">
                        <span class="text-lg w-6 text-center text-pink-400"><i class="fa-solid fa-ticket-simple"></i></span>
                        <span class="nav-label">Cetak Tiket Mandiri</span>
                    </div>
                </button>

                <!-- Nav Item 4: Panel Petugas -->
                <button onclick="switchTab('petugas')" id="nav-petugas" class="nav-btn w-full flex items-center justify-between px-4 py-3.5 rounded-2xl text-sm font-semibold text-slate-400 hover:text-white hover:bg-white/5 transition-all border border-transparent">
                    <div class="flex items-center gap-3.5">
                        <span class="text-lg w-6 text-center text-emerald-400"><i class="fa-solid fa-headset"></i></span>
                        <span class="nav-label">Panel Petugas</span>
                    </div>
                    <span class="text-[10px] bg-rose-500/20 text-rose-300 border border-rose-500/40 px-2 py-0.5 rounded-full font-mono animate-pulse">Live</span>
                </button>

                <!-- Nav Item 5: Admin Settings -->
                <button onclick="switchTab('admin')" id="nav-admin" class="nav-btn w-full flex items-center justify-between px-4 py-3.5 rounded-2xl text-sm font-semibold text-slate-400 hover:text-white hover:bg-white/5 transition-all border border-transparent">
                    <div class="flex items-center gap-3.5">
                        <span class="text-lg w-6 text-center text-amber-400"><i class="fa-solid fa-sliders"></i></span>
                        <span class="nav-label">Admin Settings</span>
                    </div>
                </button>

            </nav>
        </div>

        <!-- Sidebar Footer & System Info -->
        <div class="p-3 border-t border-white/10 space-y-3">
            
            <!-- System Status Card -->
            <div class="p-3.5 rounded-2xl bg-slate-900/60 border border-cyan-500/20 text-xs">
                <div class="flex items-center gap-2.5 text-cyan-400 font-semibold">
                    <div class="pulse-dot"></div>
                    <span>Sistem Antrean Active</span>
                </div>
                <div class="text-[11px] text-slate-400 font-mono mt-1.5 flex justify-between">
                    <span>Server Status:</span>
                    <span class="text-emerald-400 font-semibold"><i class="fa-solid fa-signal text-[9px] mr-1"></i> Connected</span>
                </div>
            </div>

            <!-- User Profile Card -->
            <div class="p-3 rounded-2xl bg-white/5 border border-white/10 flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center font-extrabold text-white text-sm shadow">
                    <i class="fa-solid fa-user-gear text-xs"></i>
                </div>
                <div class="overflow-hidden">
                    <div class="text-xs font-bold text-slate-100 truncate">Administrator ULT</div>
                    <div class="text-[10px] text-slate-400 truncate">BBPMP Sulawesi Selatan</div>
                </div>
            </div>

        </div>
    </aside>

    <main class="flex-1 flex flex-col min-h-screen relative z-10 overflow-x-hidden">
        
        <!-- Header Bar -->
        <header class="bg-[#071322]/70 backdrop-blur-md border-b border-sky-900/30 px-6 py-3.5 flex flex-wrap items-center justify-between gap-4 z-20 relative">
            
            <div class="corner-hud-tl opacity-40"></div>
            <div class="corner-hud-tr opacity-40"></div>

            <div class="flex items-center gap-3 pl-10 md:pl-0">
                <span class="w-2.5 h-2.5 rounded-full bg-cyan-400 shadow-sm shadow-cyan-400 animate-pulse"></span>
                <span class="text-xs font-mono tracking-widest text-cyan-400 uppercase">Unit Layanan Terpadu (ULT)</span>
                <span class="text-slate-600">/</span>
                <span id="page-title" class="text-xs font-semibold text-slate-200">Beranda Portal System</span>
            </div>

            <div class="flex items-center gap-4 text-xs">
                <!-- Status Layanan Badge -->
                <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 rounded-xl bg-slate-900/80 border border-slate-700/50 text-slate-300">
                    <i class="fa-regular fa-clock text-cyan-400"></i>
                    <span>Jam Layanan: <strong class="text-emerald-400 font-mono">08:00 - 15:30 WITA</strong></span>
                </div>

                <!-- Digital Clock Widget -->
                <div class="flex items-center gap-3 px-4 py-1.5 rounded-xl bg-gradient-to-r from-sky-950/80 to-blue-950/80 border border-cyan-500/30 shadow-inner">
                    <div class="text-right">
                        <div id="clock-time" class="font-mono text-xs font-bold text-cyan-300 tracking-wider">00:00:00 WITA</div>
                        <div id="clock-date" class="text-[10px] text-slate-400 font-medium">Rabu, 19 Ags 2026</div>
                    </div>
                    <div class="w-8 h-8 rounded-lg bg-cyan-500/10 border border-cyan-500/30 flex items-center justify-center text-cyan-400">
                        <i class="fa-regular fa-calendar-days text-xs"></i>
                    </div>
                </div>
            </div>
        </header>

        <!-- View Content Area -->
        <div class="flex-1 p-4 md:p-8 flex flex-col justify-between relative overflow-y-auto">

            <!-- ================= VIEW 1: HOME TAB ================= -->
            <section id="tab-home" class="tab-content block space-y-8 max-w-7xl mx-auto w-full my-auto py-4">
                
                <div class="relative glass-card-glow rounded-3xl p-8 md:p-12 text-center overflow-hidden border border-cyan-500/30 shadow-2xl">
                    
                    <div class="corner-hud-tl"></div>
                    <div class="corner-hud-tr"></div>
                    <div class="corner-hud-bl"></div>
                    <div class="corner-hud-br"></div>

                    <div class="absolute inset-0 dot-grid-pattern opacity-20 pointer-events-none"></div>

                    <div class="relative z-10 max-w-3xl mx-auto space-y-4">
                        
                        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-blue-900/40 border border-blue-400/30 text-xs font-semibold text-cyan-300 mb-2">
                            <i class="fa-solid fa-building-columns text-cyan-400"></i>
                            <span>BBPMP PROVINSI SULAWESI SELATAN</span>
                        </div>

                        <h1 class="text-2xl sm:text-4xl md:text-5xl font-black tracking-tight text-white leading-tight">
                            Selamat Datang di Antrian ULT <br>
                            <span class="bg-gradient-to-r from-cyan-400 via-sky-300 to-indigo-300 bg-clip-text text-transparent">
                                BBPMP Sulawesi Selatan
                            </span>
                        </h1>
                        
                        <p class="text-sm md:text-base text-slate-300 max-w-2xl mx-auto font-light leading-relaxed">
                            Sistem Manajemen Antrean Unit Layanan Terpadu terintegrasi secara cepat, transparan, dan akuntabel.
                        </p>

                        <!-- Quick Navigation Cards Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 pt-8">
                            
                            <!-- Card 1: Panel Petugas -->
                            <button onclick="switchTab('petugas')" class="group relative glass-card p-6 rounded-2xl hover:border-cyan-400/60 transition-all duration-300 hover:-translate-y-1 text-center flex flex-col items-center justify-between overflow-hidden">
                                <div class="w-14 h-14 rounded-2xl bg-slate-900/80 border border-emerald-500/40 flex items-center justify-center text-3xl mb-3 group-hover:scale-110 transition-transform">
                                    🎧
                                </div>
                                <div>
                                    <h3 class="text-base font-bold text-white group-hover:text-cyan-300 transition-colors">Panel Petugas</h3>
                                    <p class="text-xs text-slate-400 mt-1">Layanan panggil & meja counter</p>
                                </div>
                                <div class="mt-4 flex items-center text-xs font-medium text-emerald-400 gap-2">
                                    <span>Buka Panel</span>
                                    <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                                </div>
                            </button>

                            <!-- Card 2: Layar Display TV -->
                            <button onclick="switchTab('display')" class="group relative glass-card p-6 rounded-2xl hover:border-cyan-400/60 transition-all duration-300 hover:-translate-y-1 text-center flex flex-col items-center justify-between overflow-hidden">
                                <div class="w-14 h-14 rounded-2xl bg-slate-900/80 border border-cyan-500/40 flex items-center justify-center text-3xl mb-3 group-hover:scale-110 transition-transform">
                                    📺
                                </div>
                                <div>
                                    <h3 class="text-base font-bold text-white group-hover:text-cyan-300 transition-colors">Layar Display TV</h3>
                                    <p class="text-xs text-slate-400 mt-1">Tampilan Publik Monitor TV</p>
                                </div>
                                <div class="mt-4 flex items-center text-xs font-medium text-cyan-400 gap-2">
                                    <span>Tampilkan Display</span>
                                    <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                                </div>
                            </button>

                            <!-- Card 3: Cetak Tiket -->
                            <button onclick="switchTab('tiket')" class="group relative glass-card p-6 rounded-2xl hover:border-cyan-400/60 transition-all duration-300 hover:-translate-y-1 text-center flex flex-col items-center justify-between overflow-hidden">
                                <div class="w-14 h-14 rounded-2xl bg-slate-900/80 border border-pink-500/40 flex items-center justify-center text-3xl mb-3 group-hover:scale-110 transition-transform">
                                    🎟️
                                </div>
                                <div>
                                    <h3 class="text-base font-bold text-white group-hover:text-cyan-300 transition-colors">Cetak Tiket</h3>
                                    <p class="text-xs text-slate-400 mt-1">Kios Mandiri Nomor Antrean</p>
                                </div>
                                <div class="mt-4 flex items-center text-xs font-medium text-pink-400 gap-2">
                                    <span>Buka Kios</span>
                                    <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                                </div>
                            </button>

                        </div>
                    </div>
                </div>

                <!-- Statistics Widgets Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="glass-card p-4 rounded-2xl border border-sky-900/40 flex items-center gap-4 relative overflow-hidden">
                        <div class="corner-hud-tl opacity-30"></div>
                        <div class="w-10 h-10 rounded-xl bg-blue-500/10 border border-blue-500/30 flex items-center justify-center text-blue-400 text-lg">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <div>
                            <div class="text-[11px] text-slate-400 font-medium">Total Pengunjung Hari Ini</div>
                            <div class="text-xl font-bold font-mono text-white" id="home_st_total">128</div>
                        </div>
                    </div>

                    <div class="glass-card p-4 rounded-2xl border border-sky-900/40 flex items-center gap-4 relative overflow-hidden">
                        <div class="w-10 h-10 rounded-xl bg-amber-500/10 border border-amber-500/30 flex items-center justify-center text-amber-400 text-lg">
                            <i class="fa-solid fa-hourglass-half"></i>
                        </div>
                        <div>
                            <div class="text-[11px] text-slate-400 font-medium">Antrean Menunggu</div>
                            <div class="text-xl font-bold font-mono text-amber-300" id="home_st_sisa">5 Orang</div>
                        </div>
                    </div>

                    <div class="glass-card p-4 rounded-2xl border border-sky-900/40 flex items-center gap-4 relative overflow-hidden">
                        <div class="w-10 h-10 rounded-xl bg-emerald-500/10 border border-emerald-500/30 flex items-center justify-center text-emerald-400 text-lg">
                            <i class="fa-solid fa-face-smile"></i>
                        </div>
                        <div>
                            <div class="text-[11px] text-slate-400 font-medium">Skor IKM Layanan</div>
                            <div class="text-xl font-bold font-mono text-emerald-300">98.6 <span class="text-xs font-normal text-slate-400">/ 100</span></div>
                        </div>
                    </div>

                    <div class="glass-card p-4 rounded-2xl border border-sky-900/40 flex items-center gap-4 relative overflow-hidden">
                        <div class="corner-hud-br opacity-30"></div>
                        <div class="w-10 h-10 rounded-xl bg-purple-500/10 border border-purple-500/30 flex items-center justify-center text-purple-400 text-lg">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <div class="text-[11px] text-slate-400 font-medium">Lokasi Pelayanan</div>
                            <div class="text-xs font-semibold text-slate-200">Unit Layanan Terpadu BBPMP SULSEL</div>
                        </div>
                    </div>
                </div>

            </section>

            <!-- ================= VIEW 2: LAYAR DISPLAY TV TAB ================= -->
            <section id="tab-display" class="tab-content hidden space-y-6 w-full max-w-7xl mx-auto my-auto">
                <div class="text-center space-y-2 py-2">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-cyan-950/80 border border-cyan-500/30 text-xs font-mono text-cyan-300">
                        <i class="fa-solid fa-satellite-dish text-cyan-400 animate-pulse"></i> DISPLAY MONITOR UTAMA RUANG TUNGGU
                    </div>
                    <h2 class="text-xl sm:text-3xl font-black tracking-wider text-white uppercase">
                        UNIT LAYANAN TERPADU (ULT) BBPMP SULAWESI SELATAN
                    </h2>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">
                    
                    <div class="lg:col-span-8 glass-card-glow rounded-3xl p-8 md:p-12 text-center flex flex-col justify-between relative border border-cyan-500/40 shadow-2xl min-h-[380px]">
                        
                        <div class="corner-hud-tl scale-125"></div>
                        <div class="corner-hud-tr scale-125"></div>
                        <div class="corner-hud-bl scale-125"></div>
                        <div class="corner-hud-br scale-125"></div>

                        <div class="flex justify-between items-center text-xs font-mono text-sky-300 border-b border-sky-900/40 pb-4">
                            <span class="flex items-center gap-2">
                                <i class="fa-solid fa-bullhorn text-cyan-400 text-sm"></i>
                                STATUS PEMANGGILAN ANTREAN
                            </span>
                            <span class="px-2.5 py-1 rounded-md bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">
                                ACTIVE DISPLAY
                            </span>
                        </div>

                        <div class="my-auto py-6">
                            <p class="text-slate-300 text-sm md:text-base font-semibold tracking-widest uppercase mb-2">
                                NOMOR ANTREAN DIPANGGIL
                            </p>
                            
                            <div id="tv-queue-number" class="text-6xl sm:text-8xl md:text-9xl font-black font-mono tracking-wider bg-gradient-to-r from-cyan-300 via-white to-sky-400 bg-clip-text text-transparent drop-shadow-[0_0_35px_rgba(0,168,255,0.6)] my-2">
                                A-01
                            </div>

                            <div class="mt-4 inline-block px-8 py-3 rounded-2xl bg-gradient-to-r from-cyan-950 to-blue-950 border border-cyan-400/50 shadow-lg shadow-cyan-950">
                                <p id="tv-counter-name" class="text-xl sm:text-2xl font-bold text-cyan-300 tracking-wider">
                                    MEJA PELAYANAN UTAMA 02
                                </p>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-sky-900/40 flex flex-wrap items-center justify-between text-xs text-slate-400 gap-3">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-volume-high text-cyan-400"></i>
                                <span>Panggilan Suara : <strong class="text-emerald-400">Aktif</strong></span>
                            </div>
                            <button onclick="playChimeAndVoice('A-01', '02')" class="px-4 py-2 rounded-xl bg-cyan-600/30 hover:bg-cyan-600/50 border border-cyan-400/40 text-cyan-200 font-medium transition-all flex items-center gap-2">
                                <i class="fa-solid fa-bell"></i> Simulasi Bel Panggil Suara
                            </button>
                        </div>
                    </div>

                    <div class="lg:col-span-4 flex flex-col gap-4">
                        <div class="glass-card rounded-2xl p-5 border border-sky-900/40 flex-1 flex flex-col justify-between relative overflow-hidden">
                            <div class="corner-hud-tr opacity-40"></div>
                            
                            <h3 class="text-sm font-bold text-slate-200 flex items-center gap-2 mb-4 pb-2 border-b border-sky-900/40">
                                <i class="fa-solid fa-list-ol text-cyan-400"></i>
                                Antrean Berikutnya
                            </h3>

                            <div class="space-y-2.5 my-auto">
                                <div class="p-3 rounded-xl bg-[#09182c] border border-cyan-900/40 flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <span class="w-2 h-2 rounded-full bg-cyan-400"></span>
                                        <span id="next-queue-1" class="font-mono font-bold text-lg text-cyan-300">A-02</span>
                                    </div>
                                    <span class="text-xs text-slate-400">Pelayanan Tamu</span>
                                </div>
                                <div class="p-3 rounded-xl bg-[#081527] border border-sky-900/30 flex items-center justify-between opacity-80">
                                    <div class="flex items-center gap-3">
                                        <span class="w-2 h-2 rounded-full bg-slate-500"></span>
                                        <span id="next-queue-2" class="font-mono font-bold text-base text-slate-300">A-03</span>
                                    </div>
                                    <span class="text-xs text-slate-400">Pelayanan Tamu</span>
                                </div>
                                <div class="p-3 rounded-xl bg-[#081527] border border-sky-900/30 flex items-center justify-between opacity-60">
                                    <div class="flex items-center gap-3">
                                        <span class="w-2 h-2 rounded-full bg-slate-600"></span>
                                        <span id="next-queue-3" class="font-mono font-bold text-base text-slate-400">A-04</span>
                                    </div>
                                    <span class="text-xs text-slate-500">Pelayanan Tamu</span>
                                </div>
                            </div>

                            <div class="mt-4 pt-3 border-t border-sky-900/30 text-center text-xs text-slate-400 font-mono">
                                Petugas Standby: <span class="text-emerald-400 font-bold">4 Meja</span>
                            </div>
                        </div>

                        <div class="glass-card rounded-2xl p-5 border border-sky-900/40 relative">
                            <div class="corner-hud-br opacity-40"></div>
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-8 h-8 rounded-lg bg-amber-500/20 text-amber-400 flex items-center justify-center">
                                    <i class="fa-solid fa-circle-info text-sm"></i>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-slate-200">Maklumat Pelayanan</h4>
                                    <p class="text-[10px] text-slate-400">BBPMP Provinsi Sulawesi Selatan</p>
                                </div>
                            </div>
                            <p class="text-xs text-slate-300 italic leading-relaxed">
                                "Kami siap memberikan pelayanan informasi, konsultasi, dan fasilitasi mutu pendidikan secara prima, cepat, dan tanpa pungutan biaya."
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ================= VIEW 3: CETAK TIKET TAB (1 KOLOM) ================= -->
            <section id="tab-tiket" class="tab-content hidden space-y-6 w-full max-w-xl mx-auto my-auto">
                <div class="glass-card-glow rounded-3xl p-8 md:p-10 border border-cyan-500/30 shadow-2xl relative">
                    <div class="corner-hud-tl"></div>
                    <div class="corner-hud-tr"></div>
                    <div class="corner-hud-bl"></div>
                    <div class="corner-hud-br"></div>

                    <div class="text-center space-y-2 mb-8">
                        <div class="inline-block px-3 py-1 rounded-full bg-pink-950/80 border border-pink-500/40 text-pink-300 text-xs font-mono">
                            KIOS MANDIRI PENGAMBILAN ANTREAN
                        </div>
                        <h2 class="text-2xl md:text-3xl font-black text-white">Tiket Pelayanan Tamu</h2>
                        <p class="text-xs md:text-sm text-slate-300">Sentuh tombol di bawah untuk mengambil nomor antrean Anda</p>
                    </div>

                    <!-- Single Column Card -->
                    <div class="flex justify-center">
                        <button onclick="printTicket('Pelayanan Tamu', 'A')" class="w-full p-8 rounded-2xl bg-gradient-to-r from-cyan-950 via-blue-950 to-indigo-950 border border-cyan-500/50 hover:border-cyan-400 text-center transition-all hover:scale-[1.02] shadow-xl flex flex-col items-center justify-center gap-4 group">
                            <div class="w-20 h-20 rounded-2xl bg-cyan-500/20 text-cyan-300 flex items-center justify-center text-4xl font-extrabold font-mono border border-cyan-400/30 group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-ticket"></i>
                            </div>
                            <div>
                                <h3 class="font-extrabold text-xl text-white group-hover:text-cyan-300 transition-colors">Cetak Tiket Pelayanan Tamu</h3>
                                <p class="text-xs text-slate-300 mt-2">Layanan konsultasi, penjaminan mutu, legalitas, dan informasi publik</p>
                            </div>
                            <span class="mt-2 px-5 py-2 rounded-xl bg-cyan-500/20 text-cyan-300 border border-cyan-400/40 font-semibold text-xs flex items-center gap-2">
                                <i class="fa-solid fa-print"></i> Ambil Nomor Antrean
                            </span>
                        </button>
                    </div>

                    <div id="print-toast" class="hidden mt-6 p-4 rounded-xl bg-emerald-950/90 border border-emerald-500 text-emerald-300 text-center text-sm font-mono animate-bounce">
                        <i class="fa-solid fa-print mr-2"></i> Tiket Antrean Berhasil Dicetak! Silakan ambil kertas tiket Anda.
                    </div>
                </div>
            </section>

            <!-- ================= VIEW 4: PANEL PETUGAS TAB ================= -->
            <section id="tab-petugas" class="tab-content hidden space-y-6 w-full max-w-5xl mx-auto my-auto">
                <div class="glass-card-glow rounded-3xl p-8 border border-cyan-500/30 shadow-2xl relative">
                    <div class="corner-hud-tl"></div>
                    <div class="corner-hud-tr"></div>
                    <div class="corner-hud-bl"></div>
                    <div class="corner-hud-br"></div>

                    <div class="flex flex-wrap items-center justify-between gap-4 mb-8 pb-4 border-b border-sky-900/40">
                        <div>
                            <h2 class="text-2xl font-bold text-white flex items-center gap-2">
                                🎧 Panel Pemanggilan Antrean Meja 02
                            </h2>
                            <p class="text-xs text-slate-400 mt-1">Petugas Layanan: <strong>Ahmad Dahlan, S.Pd.</strong></p>
                        </div>
                        <span class="px-3 py-1 rounded-full bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 text-xs font-mono">
                            MEJA ONLINE
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                        <div class="bg-[#09182b] p-6 rounded-2xl border border-sky-900/40 text-center space-y-4">
                            <span class="text-xs text-slate-400 uppercase tracking-widest">Antrean Sedang Dilayani</span>
                            <div id="staff-current-queue" class="text-6xl font-black font-mono text-cyan-300 my-2">A-01</div>
                            <div class="text-xs text-slate-300 bg-sky-950/60 py-2 px-4 rounded-lg inline-block border border-sky-800/40">
                                Waktu Mulai: <span id="call-start-time">08:14 WITA</span>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <button onclick="nextQueue()" class="w-full py-4 rounded-2xl bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-slate-950 font-extrabold text-base transition-all shadow-lg shadow-cyan-500/20 flex items-center justify-center gap-3">
                                <i class="fa-solid fa-circle-play text-xl"></i> PANGGIL ANTREAN NEXT
                            </button>

                            <button onclick="recallQueue()" class="w-full py-3 rounded-2xl bg-slate-800 hover:bg-slate-700 text-slate-200 font-semibold text-sm transition-all border border-slate-600 flex items-center justify-center gap-2">
                                <i class="fa-solid fa-bullhorn text-amber-400"></i> Panggil Ulang (Re-call)
                            </button>

                            <div class="grid grid-cols-2 gap-3 pt-2">
                                <button onclick="finishQueue()" class="py-3 rounded-xl bg-emerald-950/80 hover:bg-emerald-900 text-emerald-300 border border-emerald-600/40 font-semibold text-xs transition-all flex items-center justify-center gap-1.5">
                                    <i class="fa-solid fa-check"></i> Selesai Layanan
                                </button>
                                <button onclick="skipQueue()" class="py-3 rounded-xl bg-rose-950/80 hover:bg-rose-900 text-rose-300 border border-rose-600/40 font-semibold text-xs transition-all flex items-center justify-center gap-1.5">
                                    <i class="fa-solid fa-forward"></i> Dilewati (Skip)
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ================= VIEW 5: ADMIN SETTINGS TAB ================= -->
            <section id="tab-admin" class="tab-content hidden space-y-6 w-full max-w-6xl mx-auto my-auto">
                
                <!-- Admin Header & Daily Reset Button -->
                <div class="bg-[#091b33]/80 backdrop-blur-md border border-cyan-500/30 rounded-2xl p-6 flex flex-wrap justify-between items-center gap-4">
                    <div>
                        <h2 class="text-2xl font-bold text-white flex items-center gap-2">
                            ⚙️ Pengaturan Sistem & Admin Portal
                        </h2>
                        <p class="text-xs text-slate-400 mt-1">Kelola reset harian, suara wanita (TTS), running text, dan evaluasi antrean.</p>
                    </div>
                    <button onclick="resetAntrian()" class="bg-gradient-to-r from-red-600 to-rose-700 hover:from-red-500 hover:to-rose-600 border border-rose-400/40 text-white font-bold text-xs px-5 py-3 rounded-full transition-all shadow-lg shadow-rose-950 flex items-center gap-2">
                        <span>🗑️</span> Reset Antrean Harian
                    </button>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    
                    <!-- Card 1: Text To Speech Female Voice Controls -->
                    <div class="glass-card-glow rounded-3xl p-6 border border-cyan-500/30 relative space-y-5">
                        <div class="corner-hud-tl"></div>
                        <div class="corner-hud-tr"></div>
                        
                        <div class="text-base font-bold text-white flex items-center gap-2 pb-3 border-b border-sky-900/40">
                            <span>👩‍💼</span> Pengaturan Voice Wanita (Text-To-Speech)
                        </div>

                        <div class="space-y-4 text-xs">
                            <div>
                                <div class="flex justify-between text-slate-300 font-medium mb-1.5">
                                    <label>Kecepatan Suara (Speech Rate):</label>
                                    <span id="rate-val" class="font-mono text-cyan-400 font-bold">1.0</span>
                                </div>
                                <input type="range" id="rate" min="0.5" max="1.5" step="0.1" value="1.0" oninput="updateSpeechLabel()">
                            </div>

                            <div>
                                <div class="flex justify-between text-slate-300 font-medium mb-1.5">
                                    <label>Nada Suara Wanita (Speech Pitch):</label>
                                    <span id="pitch-val" class="font-mono text-cyan-400 font-bold">1.2</span>
                                </div>
                                <input type="range" id="pitch" min="0.8" max="1.6" step="0.1" value="1.2" oninput="updateSpeechLabel()">
                            </div>

                            <label class="flex items-center gap-3 text-slate-200 cursor-pointer pt-2">
                                <input type="checkbox" id="chime" checked class="w-4 h-4 accent-cyan-500 cursor-pointer">
                                <span>Bunyikan Bel Chime Dual-Tone Sebelum Suara</span>
                            </label>

                            <button onclick="testSpeechVoice()" class="w-full py-2.5 rounded-xl bg-cyan-600/30 hover:bg-cyan-600/50 border border-cyan-400/40 text-cyan-200 font-semibold transition-all flex items-center justify-center gap-2">
                                <i class="fa-solid fa-volume-high"></i> Tes Pengujian Suara Panggil
                            </button>
                        </div>
                    </div>

                    <!-- Card 2: Running Text Ticker Config -->
                    <div class="glass-card-glow rounded-3xl p-6 border border-cyan-500/30 relative space-y-5 flex flex-col justify-between">
                        <div class="corner-hud-tl"></div>
                        <div class="corner-hud-tr"></div>

                        <div class="text-base font-bold text-white flex items-center gap-2 pb-3 border-b border-sky-900/40">
                            <span>📢</span> Pengaturan Teks Berjalan (Running Text)
                        </div>

                        <div class="space-y-3">
                            <label class="block text-xs text-slate-300 font-medium">Pesan Teks Ticker di Footer Display TV:</label>
                            <textarea id="running_text" class="w-full h-28 bg-[#030d1a] border border-cyan-900/50 rounded-2xl p-3.5 text-xs text-cyan-200 outline-none focus:border-cyan-400 transition-all font-sans leading-relaxed">Selamat Datang di Unit Layanan Terpadu (ULT) BBPMP Provinsi Sulawesi Selatan. Jam Operasional Pelayanan: Senin s.d Jumat Pukul 08.00 - 15.30 WITA. Seluruh Layanan Bebas Pungutan Biaya (Gratis / WBK).</textarea>
                        </div>

                        <button type="button" onclick="saveSettings()" class="w-full bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 border border-emerald-400/30 text-white font-bold text-sm py-3 rounded-full transition-all shadow-lg shadow-emerald-950 flex items-center justify-center gap-2">
                            <i class="fa-solid fa-floppy-disk"></i> Simpan Teks & Voice
                        </button>
                    </div>

                </div>

                <!-- Card 3: Summary Statistics Grid -->
                <div class="glass-card-glow rounded-3xl p-6 border border-cyan-500/30 relative space-y-4">
                    <div class="corner-hud-bl opacity-40"></div>
                    <div class="corner-hud-br opacity-40"></div>

                    <div class="text-base font-bold text-white flex items-center gap-2 pb-2 border-b border-sky-900/40">
                        <span>📊</span> Ringkasan Statistik Hari Ini
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 pt-2">
                        <div class="bg-slate-900/60 border border-slate-700/50 rounded-2xl p-4 text-center">
                            <div class="text-xs text-slate-400 font-medium mb-1">Total Tiket</div>
                            <div class="text-3xl font-extrabold font-mono text-cyan-400" id="st_total">128</div>
                        </div>

                        <div class="bg-slate-900/60 border border-slate-700/50 rounded-2xl p-4 text-center">
                            <div class="text-xs text-slate-400 font-medium mb-1">Selesai</div>
                            <div class="text-3xl font-extrabold font-mono text-emerald-400" id="st_selesai">123</div>
                        </div>

                        <div class="bg-slate-900/60 border border-slate-700/50 rounded-2xl p-4 text-center">
                            <div class="text-xs text-slate-400 font-medium mb-1">Dilewati</div>
                            <div class="text-3xl font-extrabold font-mono text-rose-400" id="st_skip">0</div>
                        </div>

                        <div class="bg-slate-900/60 border border-slate-700/50 rounded-2xl p-4 text-center">
                            <div class="text-xs text-slate-400 font-medium mb-1">Sisa Antrean</div>
                            <div class="text-3xl font-extrabold font-mono text-amber-400" id="st_sisa">5</div>
                        </div>
                    </div>
                </div>

            </section>

        </div>

        <footer class="bg-[#030a14] border-t border-sky-900/40 py-2.5 px-4 overflow-hidden relative z-20 flex items-center">
            
            <div class="flex items-center gap-2 bg-gradient-to-r from-amber-500 to-orange-600 text-slate-950 font-black text-xs px-3 py-1 rounded-md shadow-md z-10 flex-shrink-0 mr-4">
                <i class="fa-solid fa-bullhorn text-xs animate-bounce"></i>
                <span class="tracking-wider uppercase">INFO ULT</span>
            </div>

            <div class="overflow-hidden w-full relative flex items-center">
                <div id="footer-ticker" class="animate-marquee whitespace-nowrap text-xs text-amber-300 font-medium tracking-wide flex items-center gap-8">
                    <span>Selamat Datang di Unit Layanan Terpadu (ULT) BBPMP Provinsi Sulawesi Selatan</span>
                    <span class="text-cyan-400">•</span>
                    <span>Jam Operasional Pelayanan: Senin s.d Jumat Pukul 08.00 - 15.30 WITA</span>
                    <span class="text-cyan-400">•</span>
                    <span>Utamakan Ketertiban dan Senyum dalam Pelayanan Publik Berkualitas</span>
                    <span class="text-cyan-400">•</span>
                    <span>Seluruh Layanan ULT BBPMP Sulsel Bebas Pungutan Biaya (Gratis / WBK)</span>
                </div>
            </div>

            <div class="hidden sm:flex items-center gap-2 text-[10px] text-slate-500 font-mono pl-4 border-l border-slate-800 flex-shrink-0">
                <i class="fa-solid fa-shield text-cyan-500"></i>
                <span>WBK BBPMP SULSEL</span>
            </div>
        </footer>

    </main>

    <script>
        // State Management
        let stats = {
            total: 128,
            selesai: 123,
            skip: 0,
            sisa: 5
        };

        let currentQueueNum = 1;
        let currentQueuePrefix = 'A';

        // Helper Function to Format Queue Number (2 Digits: 01, 02, etc.)
        function formatQueueNumber(prefix, num) {
            return prefix + '-' + String(num).padStart(2, '0');
        }

        // Tab Switcher Controller
        function switchTab(tabId) {
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.add('hidden');
                tab.classList.remove('block');
            });

            const target = document.getElementById('tab-' + tabId);
            if (target) {
                target.classList.remove('hidden');
                target.classList.add('block');
            }

            const pageTitleMap = {
                'home': 'Beranda Portal System',
                'display': 'Layar Display TV Ruang Tunggu',
                'tiket': 'Kios Cetak Tiket Mandiri',
                'petugas': 'Panel Operasional Petugas',
                'admin': 'Pengaturan Dashboard System'
            };
            document.getElementById('page-title').innerText = pageTitleMap[tabId] || 'Portal System';

            document.querySelectorAll('.nav-btn').forEach(btn => {
                btn.classList.remove('bg-gradient-to-r', 'from-cyan-500/30', 'to-blue-600/40', 'text-white', 'border-cyan-400/50', 'shadow-lg', 'shadow-cyan-950');
                btn.classList.add('text-slate-400', 'border-transparent');
            });

            const activeBtn = document.getElementById('nav-' + tabId);
            if (activeBtn) {
                activeBtn.classList.add('bg-gradient-to-r', 'from-cyan-500/30', 'to-blue-600/40', 'text-white', 'border-cyan-400/50', 'shadow-lg', 'shadow-cyan-950');
                activeBtn.classList.remove('text-slate-400', 'border-transparent');
            }

            // Close mobile menu if open
            const sidebar = document.getElementById('sidebar-menu');
            const overlay = document.getElementById('sidebar-overlay');
            if (!sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }

        // Mobile Sidebar Toggle
        function toggleMobileSidebar() {
            const sidebar = document.getElementById('sidebar-menu');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        // Realtime Digital Clock
        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('clock-time').innerText = `${hours}:${minutes}:${seconds} WITA`;

            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
            
            document.getElementById('clock-date').innerText = `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;
        }

        // Web Audio API Dual-Tone Chime Simulator
        function playChime(callback) {
            const playChimeEnabled = document.getElementById('chime') ? document.getElementById('chime').checked : true;
            if (!playChimeEnabled) {
                if (callback) callback();
                return;
            }

            try {
                const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
                
                // Tone 1: E5
                const osc1 = audioCtx.createOscillator();
                const gain1 = audioCtx.createGain();
                osc1.type = 'sine';
                osc1.frequency.setValueAtTime(659.25, audioCtx.currentTime);
                gain1.gain.setValueAtTime(0.35, audioCtx.currentTime);
                gain1.gain.exponentialRampToValueAtTime(0.001, audioCtx.currentTime + 1.2);
                osc1.connect(gain1);
                gain1.connect(audioCtx.destination);
                osc1.start();
                osc1.stop(audioCtx.currentTime + 1.2);

                // Tone 2: C5
                setTimeout(() => {
                    const osc2 = audioCtx.createOscillator();
                    const gain2 = audioCtx.createGain();
                    osc2.type = 'sine';
                    osc2.frequency.setValueAtTime(523.25, audioCtx.currentTime);
                    gain2.gain.setValueAtTime(0.35, audioCtx.currentTime);
                    gain2.gain.exponentialRampToValueAtTime(0.001, audioCtx.currentTime + 1.5);
                    osc2.connect(gain2);
                    gain2.connect(audioCtx.destination);
                    osc2.start();
                    osc2.stop(audioCtx.currentTime + 1.5);

                    if (callback) {
                        setTimeout(callback, 1200);
                    }
                }, 400);

            } catch(e) {
                console.log('Audio Context Error', e);
                if (callback) callback();
            }
        }

        // Web Speech API - Female Indonesian Text-To-Speech Queue Voice
        function speakQueue(ticketFormatted, counterNum) {
            if ('speechSynthesis' in window) {
                window.speechSynthesis.cancel(); // Stop prior speech

                const speechRate = parseFloat(document.getElementById('rate').value || 1.0);
                const speechPitch = parseFloat(document.getElementById('pitch').value || 1.2);

                // Format number text for speech e.g., "Nomor antrean A, kosong, satu, silakan menuju ke meja dua"
                const parts = ticketFormatted.split('-');
                const letter = parts[0];
                const numbers = parts[1].split('').map(n => {
                    if (n === '0') return 'kosong';
                    if (n === '1') return 'satu';
                    if (n === '2') return 'dua';
                    if (n === '3') return 'tiga';
                    if (n === '4') return 'empat';
                    if (n === '5') return 'lima';
                    if (n === '6') return 'enam';
                    if (n === '7') return 'tujuh';
                    if (n === '8') return 'delapan';
                    if (n === '9') return 'sembilan';
                    return n;
                }).join(', ');

                const speechText = `Nomor antrean, ${letter}, ${numbers}, silakan menuju ke meja ${counterNum}`;

                const utterance = new SpeechSynthesisUtterance(speechText);
                utterance.lang = 'id-ID';
                utterance.rate = speechRate;
                utterance.pitch = speechPitch;

                // Attempt to pick female or Indonesian voice
                const voices = window.speechSynthesis.getVoices();
                const idVoice = voices.find(v => v.lang.includes('id') || v.name.includes('Indonesian') || v.name.includes('Gadis') || v.name.includes('Female'));
                if (idVoice) utterance.voice = idVoice;

                window.speechSynthesis.speak(utterance);
            }
        }

        function playChimeAndVoice(ticket, counter) {
            playChime(() => {
                speakQueue(ticket, counter);
            });
        }

        function testSpeechVoice() {
            playChimeAndVoice('A-01', '02');
        }

        function updateSpeechLabel() {
            document.getElementById('rate-val').innerText = parseFloat(document.getElementById('rate').value).toFixed(1);
            document.getElementById('pitch-val').innerText = parseFloat(document.getElementById('pitch').value).toFixed(1);
        }

        function updateUIStats() {
            document.getElementById('st_total').innerText = stats.total;
            document.getElementById('st_selesai').innerText = stats.selesai;
            document.getElementById('st_skip').innerText = stats.skip;
            document.getElementById('st_sisa').innerText = stats.sisa;

            document.getElementById('home_st_total').innerText = stats.total;
            document.getElementById('home_st_sisa').innerText = stats.sisa + ' Orang';
        }

        // Staff Queue Actions
        function nextQueue() {
            if (stats.sisa > 0) {
                stats.sisa--;
                stats.selesai++;
            }
            stats.total++;
            currentQueueNum++;

            const formatted = formatQueueNumber(currentQueuePrefix, currentQueueNum);
            
            document.getElementById('tv-queue-number').innerText = formatted;
            document.getElementById('staff-current-queue').innerText = formatted;

            const now = new Date();
            document.getElementById('call-start-time').innerText = `${String(now.getHours()).padStart(2,'0')}:${String(now.getMinutes()).padStart(2,'0')} WITA`;

            // Update next queue list previews with 2-digit format
            document.getElementById('next-queue-1').innerText = formatQueueNumber(currentQueuePrefix, currentQueueNum + 1);
            document.getElementById('next-queue-2').innerText = formatQueueNumber(currentQueuePrefix, currentQueueNum + 2);

            updateUIStats();
            playChimeAndVoice(formatted, '02');
        }

        function recallQueue() {
            const formatted = document.getElementById('staff-current-queue').innerText;
            playChimeAndVoice(formatted, '02');
        }

        function finishQueue() {
            const formatted = document.getElementById('staff-current-queue').innerText;
            const toast = document.getElementById('print-toast');
            toast.innerText = `[PETUGAS] Antrean ${formatted} telah diselesaikan!`;
            toast.classList.remove('hidden');
            setTimeout(() => toast.classList.add('hidden'), 3000);
        }

        function skipQueue() {
            stats.skip++;
            if (stats.sisa > 0) stats.sisa--;
            updateUIStats();
            nextQueue();
        }

        // Ticket Kiosk Printing Action
        function printTicket(categoryName, prefix) {
            stats.total++;
            stats.sisa++;
            updateUIStats();

            playChime();

            const toast = document.getElementById('print-toast');
            toast.innerText = `[TERCETAK] Tiket ${categoryName} berhasil dicetak! Selamat datang di ULT.`;
            toast.classList.remove('hidden');
            setTimeout(() => {
                toast.classList.add('hidden');
            }, 4000);
        }

        // Save Running Text & Settings
        function saveSettings() {
            const text = document.getElementById('running_text').value;
            const tickerEl = document.getElementById('footer-ticker');
            
            // Rebuild ticker HTML elements
            tickerEl.innerHTML = `
                <span>${text}</span>
                <span class="text-cyan-400">•</span>
                <span>Jam Operasional Pelayanan: Senin s.d Jumat Pukul 08.00 - 15.30 WITA</span>
                <span class="text-cyan-400">•</span>
                <span>Seluruh Layanan ULT BBPMP Sulsel Bebas Pungutan Biaya (Gratis / WBK)</span>
            `;

            alert('Pengaturan teks running text & voice berhasil disimpan!');
        }

        // Reset Antrean Harian
        function resetAntrian() {
            if (confirm('Apakah Anda yakin ingin mereset seluruh antrean harian menjadi 0?')) {
                stats.total = 0;
                stats.selesai = 0;
                stats.skip = 0;
                stats.sisa = 0;
                currentQueueNum = 0;

                const resetVal = 'A-00';
                document.getElementById('tv-queue-number').innerText = resetVal;
                document.getElementById('staff-current-queue').innerText = resetVal;
                document.getElementById('next-queue-1').innerText = 'A-01';
                document.getElementById('next-queue-2').innerText = 'A-02';

                updateUIStats();
                alert('Seluruh data antrean harian telah berhasil di-reset!');
            }
        }

        // Load voices on page startup
        if ('speechSynthesis' in window) {
            window.speechSynthesis.onvoiceschanged = function() {
                window.speechSynthesis.getVoices();
            };
        }

        window.onload = function() {
            updateClock();
            setInterval(updateClock, 1000);
            updateUIStats();
            updateSpeechLabel();
        };
    </script>
</body>
</html>