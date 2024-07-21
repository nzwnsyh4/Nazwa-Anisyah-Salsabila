@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Create Maskapai</h1>
                <a href="{{ route('admin.maskapai.index') }}" class="btn btn-primary">Kembali</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.maskapai.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <x-partials.form name="name" title="Nama Maskapai" />
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="owner">Owner</label>
                                    <select name="owner" id="owner"
                                        class="select2 form-control @error('owner') is-invalid @enderror">
                                        <option value="">Select Owner</option>
                                        @foreach ($user as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }} | {{ $item->email }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('owner')
                                        <small class="fst-italic text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                            <div class="col-md-12">
                                <x-partials.textarea name="description" title="Tentang Maskapai" />
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="is_active">Status</label>
                                    <select name="is_active" id="is_active"
                                        class="select2 form-control @error('is_active') is-invalid @enderror">
                                        <option value="">Select Status</option>
                                        <option value="1">Aktif</option>
                                        <option value="0" >Tidak Aktif</option>

                                    </select>
                                    @error('is_active')
                                        <small class="fst-italic text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!--<div class="col-md-12>
                                <x-partials.form name="logo" title="Logo" type="file" />
                                <a href="#" id="linkPreview" class="spotlight" data-title="Logo">

                                    <img src="#" id="previewImage" alt="Preview"
                                        style="display: none; max-width: 200px; max-height: 200px;">
                                </a>
                            </div>-->
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary">Create</button>
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
