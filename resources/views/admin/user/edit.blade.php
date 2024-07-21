@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Edit User</h1>
                <a href="{{ route('admin.user.index') }}" class="btn btn-primary">Kembali</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <x-partials.form name="name" title="Nama Maskapai"
                                    default="{{ old('name', $user->name) }}" />
                            </div>
                            <!--<div class="col-md-6">
                                <x-partials.form name="phone" title="Phone" default="{{ old('phone', $user->phone) }}" />
                            </div>-->
                            <div class="col-md-6">
                                <x-partials.form name="email" title="Email" default="{{ old('email', $user->email) }}" />
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="role_id">Role</label>
                                    <select name="role_id" id="role_id"
                                        class="select2 form-control @error('role_id') is-invalid @enderror">
                                        <option value="">Select Role</option>
                                        @foreach ($role as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $user->hasRole($item->id) ? 'selected' : '' }}>
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                        <small class="fst-italic text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button class="btn btn-primary">Save</button>
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
