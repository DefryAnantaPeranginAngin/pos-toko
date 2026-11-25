<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Akses Ditolak - POS Barokah Mart</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-sm w-full max-w-md text-center">
        <h1 class="text-4xl font-semibold mb-2">403</h1>
        <h2 class="text-xl font-semibold mb-4">Akses Ditolak</h2>
        <p class="text-gray-600 mb-6">{{ $message }}</p>
        <a href="{{ route('dashboard') }}"
           class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-md">
            Kembali ke Dashboard
        </a>
    </div>
</body>
</html>