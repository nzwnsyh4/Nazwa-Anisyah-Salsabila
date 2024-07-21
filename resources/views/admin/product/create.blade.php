@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Create Penerbangan</h1>
                <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Kembali</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <x-partials.form name="name" title="Nama Penerbangan" />
                            </div>

                            <div class="col-md-6">
                                <x-partials.textarea name="description" title="Tentang Penerbangan" />
                            </div>
                            <div class="col-md-6">
                                <x-partials.form name="price" title="Price" />
                            </div>
                            <div class="col-md-6">
                                <x-partials.form name="qty" title="Jumlah Kursi" />
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="is_active">Status</label>
                                    <select name="is_active" id="is_active"
                                        class="select2 form-control @error('is_active') is-invalid @enderror">
                                        <option value="">Select Status</option>
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>

                                    </select>
                                    @error('is_active')
                                        <small class="fst-italic text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="from_airport">From Airport</label>
                                    <select name="from_airport" id="from_airport"
                                        class="select2-airport form-control @error('from_airport') is-invalid @enderror">



                                    </select>
                                    @error('from_airport')
                                        <small class="fst-italic text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="destination_airport">Destination Airport</label>
                                    <select name="destination_airport" id="destination_airport"
                                        class="select2-airport form-control @error('destination_airport') is-invalid @enderror">


                                    </select>
                                    @error('destination_airport')
                                        <small class="fst-italic text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-8">
                                        <x-partials.form name="estimated_fly" title="Estimasi Tanggal Terbang"
                                            type="date" />

                                    </div>
                                    <div class="col-md-4">

                                        <x-partials.form name="estimated_fly_hour" title=" Jam" type="time" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-8">
                                        <x-partials.form name="estimated_arrival" title="Estimasi Tanggal Sampai"
                                            type="date" />

                                    </div>
                                    <div class="col-md-4">

                                        <x-partials.form name="estimated_arrival_hour" title=" Jam" type="time" />
                                    </div>
                                </div>
                            </div>
                            <!--<div class="col-md-6">
                                <x-partials.upload name="thumbnail" title="Thumbnail Product" />
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
            $(".uploads").imageUploader({
                label: 'Drag & Drop files here or click to browse'
            });

            $(".select2-airport").select2({
                ajax: {
                    url: "{{ route('admin.fetch.airport') }}",
                    dataType: 'json',
                    type: 'POST',
                    delay: 250,
                    data: function(params) {
                        return {
                            _token: '{{ csrf_token() }}',
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function(data, params) {
                        // parse the results into the format expected by Select2
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data, except to indicate that infinite
                        // scrolling can be used
                        console.log(data);
                        params.page = params.page || 1;

                        return {
                            results: data.data,
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            }
                        };
                    },
                    cache: true
                },
                placeholder: 'Search for a repository',
                minimumInputLength: 1,
                templateResult: formatRepo,
                templateSelection: formatRepoSelection,
                theme: 'bootstrap-5'

            });

            function formatRepo(repo) {
                if (repo.loading) {
                    return repo.text;
                }
                // var $container = 'test';
                var $container = $(
                    "<div class='select2-result-repository clearfix'>" +
                    "<div class='select2-result-repository__meta'>" +
                    "<div class='select2-result-repository__title'></div>" +
                    "<div class='select2-result-repository__description'></div>" +
                    "<div class='select2-result-repository__country'>" +
                    "<div class='select2-result-repository__timezone'>" +
                    "</div>" +
                    "</div>" +
                    "</div>"
                );
                $container.find(".select2-result-repository__title").text(repo.name);
                $container.find(".select2-result-repository__description").text(repo.tz);
                $container.find(".select2-result-repository__country").text(repo.country + '-' + repo.city);
                $container.find(".select2-result-repository__timezone").text('2222');




                return $container;
            }

            function formatRepoSelection(repo) {
                // console.log(repo);
                return repo.name || repo.code;
            }
        });

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
