@extends('layouts.admin')

@section('title', 'Approved UMKM')

@push('style')
    <link rel="stylesheet" href="{{ asset('admin/library/select2/dist/css/select2.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Approved UMKM</h1>
            </div>

            <div class="section-body">


                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-striped table text-center table-bordered">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th class="text-white">No</th>
                                                <th class="text-white">Logo</th>
                                                <th class="text-white">Nama Pemilik UMKM</th>
                                                <th class="text-white">Nama Toko</th>
                                                <th class="text-white">Email</th>
                                                <th class="text-white">Status</th>
                                                <th class="text-white">#</th>
                                            </tr>
                                        </thead>
                                        @foreach ($umkms as $umkm)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><img src="{{ asset('uploads/logo/' . $umkm->logo) }}" width="100" />
                                                </td>
                                                <td>{{ $umkm->userUmkm->name ?? '-' }}</td>
                                                <td>{{ $umkm->nama_toko }}</td>
                                                <td>{{ $umkm->userUmkm->email ?? '-' }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button
                                                            class="btn btn-sm dropdown-toggle
                                                                @if ($umkm->status == 'pending') btn-warning
                                                                @elseif($umkm->status == 'approved') btn-success
                                                                @elseif($umkm->status == 'rejected') btn-danger
                                                                @else btn-secondary @endif"
                                                            type="button" id="statusDropdown{{ $umkm->id }}"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            {{ ucfirst($umkm->status) }}
                                                        </button>

                                                        <div class="dropdown-menu"
                                                            aria-labelledby="statusDropdown{{ $umkm->id }}">
                                                            <a class="dropdown-item" href="#"
                                                                onclick="changeStatus('{{ $umkm->id }}', 'pending')">
                                                                Pending
                                                            </a>
                                                            <a class="dropdown-item" href="#"
                                                                onclick="changeStatus('{{ $umkm->id }}', 'approved')">
                                                                Approved
                                                            </a>
                                                            <a class="dropdown-item" href="#"
                                                                onclick="changeStatus('{{ $umkm->id }}', 'rejected')">
                                                                Rejected
                                                            </a>
                                                        </div>
                                                    </div>

                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <a href="" class="btn btn-sm btn-info" style="margin-right: 5px">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                {{ $umkms->onEachSide(1)->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        function changeStatus(id, status) {
            $.ajax({
                url: '/approvedumkm/' + id + '/update-status',
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status
                },
                success: function(response) {
                    location.reload();
                }
            });
        }
    </script>
@endpush
