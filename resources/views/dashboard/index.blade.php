@extends('layout.base')

@push('custom-css')
<link rel="stylesheet" href="{{ asset('assets/libs/calendar/vanilla-calendar.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/libs/calendar/themes/light.min.css') }}" />
@endpush

@section('content')
<div class="row">
    <div class="col-lg-8 row">
        {{-- Chart --}}
        <div class="col-md-12">
            <div class="card card-flush">
                <div class="card-header">Aktivitas Siswa</div>
                <div class="card-body">
                    <div id="chart"></div>
                </div>
            </div>
        </div>

        {{-- Card --}}
        <div class="col-md-4">
            <div class="card card-flush">
                <div class="card-header d-flex gap-3 align-items-center">
                    <span class="rounded bg-primary fs-2 p-1">
                        <i class="ti ti-user dashboard-icon text-white"></i>
                    </span>
                    <span class="text-primary fw-bold">
                        Total Pelajar
                    </span>
                </div>
                <div class="card-body text-center">
                    <h1 class="fw-bold fs-7">{{ rand(300, 340) }}</h1>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-flush">
                <div class="card-header d-flex gap-3 align-items-center">
                    <span class="rounded bg-info fs-2 p-1">
                        <i class="ti ti-user dashboard-icon text-white"></i>
                    </span>
                    <span class="text-primary fw-bold">
                        Siswa Kelas
                    </span>
                </div>
                <div class="card-body text-center">
                    <h1 class="fw-bold fs-7">{{ rand(25, 35) }}</h1>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-flush">
                <div class="card-header d-flex gap-3 align-items-center">
                    <span class="rounded bg-success fs-2 p-1">
                        <i class="ti ti-user dashboard-icon text-white"></i>
                    </span>
                    <span class="text-primary fw-bold">
                        Pengumpulan Quiz
                    </span>
                </div>
                <div class="card-body text-center">
                    <h1 class="fw-bold fs-7">{{ rand(10, 34) }}</h1>
                </div>
            </div>
        </div>

        {{-- Aktivitas --}}
        <div class="col-md-12">
            <div class="card card-flush">
                <div class="card-header d-flex gap-3 align-items-center">
                    <span class="rounded bg-primary fs-2 p-1">
                        <i class="ti ti-file dashboard-icon text-white"></i>
                    </span>
                    <span class="text-primary fw-bold">
                        Baru Saja Terjadi
                    </span>
                </div>
                <div class="card-body d-flex flex-column gap-3">
                    @foreach (range(1, 3) as $item)
                    <div class="border-bottom border-2 d-flex justify-content-between gap-2 pb-2">
                        <div class="d-flex justify-content-between gap-2">
                            <img src="{{ asset('/assets/images/profile/user-1.jpg') }}" alt="" width="50" height="50" class="rounded">
                            <div class="d-flex flex-column gap-2">
                                <span><b>{{ fake()->name() }}</b> * 0878789019</span>
                                <span class="text-secondary">Melakukan pengumpulan tugas materi "Konfigurasi elektron kulit"</span>
                            </div>
                        </div>
                        <a href="#" class="align-self-center"><b>Lihat</b></a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

    <div class="col-lg-4 row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex gap-3 align-items-center">
                    <span class="rounded bg-primary fs-2 p-1">
                        <i class="ti ti-clock dashboard-icon text-white"></i>
                    </span>
                    <span class="text-primary fw-bold">
                        Timeline
                    </span>
                </div>
                <div class="card-body p-0 d-flex flex-column align-items-center">
                    <hr class="border border-2 border-dark" style="width: 85%">
                    <div>
                    </div>
                    <div class="w-100" id="timelineCalendar"></div>
                    <hr class="border border-2 border-dark" style="width: 85%">
                </div>
                <div class="card-footer">
                    Deadline Tugas 1
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-script')
<script src="{{ asset('assets/libs/calendar/vanilla-calendar.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
<script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
@endpush
