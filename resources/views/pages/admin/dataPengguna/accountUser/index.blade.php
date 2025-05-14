@extends('layouts.admin')

@section('title', 'Account User')

@push('style')
    <link rel="stylesheet" href="{{ asset('admin/library/select2/dist/css/select2.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Account User</h1>
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
                                                <th class="text-white">Nama User</th>
                                                <th class="text-white">Email</th>
                                                <th class="text-white">Status Verifikasi</th>
                                                <th class="text-white">#</th>
                                            </tr>
                                        </thead>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @if ($user->email_verified_at)
                                                        {{ \Carbon\Carbon::parse($user->email_verified_at)->translatedFormat('d F Y') }}
                                                    @else
                                                        <span class="badge bg-danger p-2 text-white"> Belum Aktif </span>
                                                    @endif
                                                </td>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <a href="" class="btn btn-sm btn-info"
                                                            style="margin-right: 5px">
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
                                {{ $users->onEachSide(1)->links('pagination::bootstrap-5') }}
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
