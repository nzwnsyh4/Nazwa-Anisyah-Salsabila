@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Create User</h1>
                <a href="{{ route('admin.user.index') }}" class="btn btn-primary">Kembali</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mt-3">
                <for="fullname">Nama Lengkap</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" required name="name"
                        value="{{ old('name') }}">
                    @error('name')
                        <small class="text-danger " style="font-style: italic">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mt-3">
                <for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" required name="email"
                        value="{{ old('email') }}">
                    @error('email')
                        <small class="text-danger " style="font-style: italic">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group" style="position: relative;">
    <label for="password">Password</label>
    <div style="position: relative;">
        <input id="password-field" type="password" class="form-control @error('password') is-invalid @enderror" required name="password">
        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></span>
    </div>
    @error('password')
        <small class="text-danger " style="font-style: italic">{{ $message }}</small>
    @enderror
</div>

                           <!-- <div class="col-md-6">
                                <x-partials.form name="logo" title="Logo" type="file" />
                                <a href="#" id="linkPreview" class="spotlight" data-title="Logo">

                                    <img src="#" id="previewImage" alt="Preview"
                                        style="display: none; max-width: 200px; max-height: 200px;">
                                </a>
                            </div> -->
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary">Buat</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            // Mendapatkan referensi ke elemen input gambar
            var inputFile = document.getElementById('logo');

            // Mendapatkan referensi ke elemen gambar preview
            var previewImage = document.getElementById('previewImage');


            // Menambahkan event listener untuk memantau perubahan pada input file
            inputFile.addEventListener('change', function() {
                // Memastikan bahwa file telah dipilih
                if (inputFile.files && inputFile.files[0]) {
                    var reader = new FileReader();

                    // Ketika file berhasil dibaca
                    reader.onload = function(e) {
                        // Menetapkan sumber gambar ke preview gambar
                        previewImage.src = e.target.result;
                        // Menampilkan preview gambar
                        previewImage.style.display = 'block';
                        $("#linkPreview").attr('href', e.target.result);
                    }
                    // Membaca file sebagai URL data
                    reader.readAsDataURL(inputFile.files[0]);
                }
            });
        });
    </script>
@endpush
