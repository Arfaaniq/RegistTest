<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tambah Produk</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <div class="p-6 max-w-3xl mx-auto ">

        <!-- Judul halaman -->
        <h1 class="text-3xl font-bold text-blue-600 mb-8 text-center drop-shadow-lg">
            Tambah Produk
        </h1>

        <form method="POST" action="{{ route('produk.store') }}" enctype="multipart/form-data" 
              class="space-y-8 bg-white shadow-xl rounded-2xl p-10 border border-blue-300">

            @csrf

            <div>
                <label for="judul" class="block text-gray-700 font-semibold mb-2">Judul:</label>
                <input
                    id="judul"
                    type="text"
                    name="judul"
                    class="w-full border border-gray-300 rounded-lg px-5 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm"
                    value="{{ old('judul') }}"
                    required
                    placeholder="Masukkan judul blog"
                >
            </div>

            <div>
                <label for="kategori" class="block text-gray-700 font-semibold mb-2">Kategori:</label>
                <input
                    id="kategori"
                    type="text"
                    name="kategori"
                    class="w-full border border-gray-300 rounded-lg px-5 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm"
                    value="{{ old('kategori') }}"
                    required
                    placeholder="Masukkan kategori blog"
                >
            </div>

            <div>
                <label for="deskripsi" class="block text-gray-700 font-semibold mb-2">Deskripsi:</label>
                <textarea
                    id="deskripsi"
                    name="deskripsi"
                    rows="6"
                    class="w-full border border-gray-300 rounded-lg px-5 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition resize-y shadow-sm"
                    required
                    placeholder="Masukkan deskripsi blog"
                >{{ old('deskripsi') }}</textarea>
            </div>

            <div>
                <label for="gambar" class="block text-gray-700 font-semibold mb-2 cursor-pointer">
                    Upload Gambar (opsional):
                </label>
                <input
                    id="gambar"
                    type="file"
                    name="gambar"
                    class="block w-full text-sm text-gray-500
                           file:mr-4 file:py-2 file:px-4
                           file:rounded-md file:border-0
                           file:text-sm file:font-semibold
                           file:bg-blue-600 file:text-white
                           hover:file:bg-blue-700
                           cursor-pointer
                           transition shadow-sm"
                >
            </div>

            <div class="flex justify-end gap-6 pt-6">
                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-lg transition shadow-lg transform hover:scale-105"
                >
                    Simpan
                </button>
                <a href="{{ route('blogs.index') }}"
                   class="bg-gray-700 hover:bg-gray-600 text-white font-semibold px-8 py-3 rounded-lg transition shadow-lg transform hover:scale-105 text-center"
                >
                    Kembali
                </a>
            </div>

        </form>
    </div>

</body>
</html>
