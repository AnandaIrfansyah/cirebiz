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
                                <!-- Tabs -->
                                <ul class="nav nav-pills mb-3" id="roleTabs" role="tablist">
                                    @foreach ($roles as $role)
                                        <li class="nav-item">
                                            <a class="nav-link {{ request('current_tab', $roles[0]) === $role ? 'active' : '' }}"
                                                id="tab-{{ $role }}-tab" data-toggle="tab"
                                                href="#tab-{{ $role }}" role="tab" style="margin-right: 8px;">
                                                {{ ucfirst($role) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>

                                <!-- Tab Contents -->
                                <div class="tab-content" id="roleTabsContent">
                                    @foreach ($roles as $role)
                                        <div class="tab-pane fade {{ request('current_tab', $roles[0]) === $role ? 'show active' : '' }}"
                                            id="tab-{{ $role }}" role="tabpanel">
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
                                                    @forelse ($usersByRole[$role] as $user)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $user->name }}</td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>
                                                                @if ($user->email_verified_at)
                                                                    {{ \Carbon\Carbon::parse($user->email_verified_at)->translatedFormat('d F Y') }}
                                                                @else
                                                                    <span class="badge bg-danger p-2 text-white"> Belum
                                                                        Aktif </span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <div
                                                                    class="d-flex justify-content-center align-items-center">
                                                                    <a href="" class="btn btn-sm btn-info"
                                                                        style="margin-right: 5px">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>
                                                                    <form action="" method="POST" class="d-inline">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button
                                                                            class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                                            <i class="fas fa-trash"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="5" class="text-muted">Tidak ada data.</td>
                                                        </tr>
                                                    @endforelse
                                                </table>
                                            </div>
                                            {{ $usersByRole[$role]->appends(['current_tab' => $role])->onEachSide(1)->links('pagination::bootstrap-5') }}
                                        </div>
                                    @endforeach
                                </div>

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
        $('#roleTabs a').on('click', function(e) {
            const tab = $(this).attr('href').replace('#tab-', '');
            const url = new URL(window.location.href);
            url.searchParams.set('current_tab', tab);
            history.replaceState({}, '', url);
        });
    </script>
@endpush
