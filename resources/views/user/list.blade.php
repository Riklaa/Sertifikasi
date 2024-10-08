@extends('super.master-layout')
@section('custom-css')
    <style>
        /* Container */
        .content-container {
            margin-top: 20px;
            /* Atur jarak atas */
            margin-bottom: 20px;
            /* Atur jarak bawah */
            padding-left: 15px;
            /* Atur jarak kiri */
            padding-right: 15px;
            /* Atur jarak kanan */
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid mt-4">
        <div class="row mt-3">
            <div class="col-12 mb-3">
                <a href="{{ route('user.create') }}" class="btn btn-primary"><i class="bx bx-plus me-1"></i>Tambah User</a>
            </div>
            <div class="container-fluid">
                <div class="row mt-10">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h4 class="mb-0">Daftar User</h4>
                                </div>
                                <hr />

                                <div class="table-responsive">
                                    <!-- <div class="my-buttons"></div> -->
                                    <br>
                                    <table id="table-utama" class="table table-lg table-striped table-bordered table-hover"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                {{-- <th>No</th> --}}
                                                <th>AKSI</th>
                                                <th>NAMA LENGKAP</th>
                                                <th>EMAIL</th>
                                                <th>ROLE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dataUser as $nomor => $value)
                                                <tr>
                                                    <td>
                                                        <a class="btn btn-warning btn-sm m-1"
                                                            href="{{ route('user.edit', ['id_user' => $value['id_user']]) }}"><i
                                                                class="bx bx-edit"></i></a>
                                                        <a class="btn btn-danger btn-sm m-1"
                                                            href="{{ route('user.delete.proses', ['id_user' => $value['id_user']]) }}"
                                                            onclick="showConfirmButton(event, '{{ route('user.delete.proses', ['id_user' => $value['id_user']]) }}')">
                                                            <i class="bx bx-trash"></i>
                                                        </a>
                                                    </td>
                                                    <td>{{ $value['nama'] }}</td>
                                                    <td>{{ $value['email'] }}</td>
                                                    <td>{{ $value['role'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endsection

    @section('js-content')
        <script>
            function showConfirmButton(event, deleteUrl) {
                event.preventDefault(); // Prevent the default link action
                Swal.fire({
                    title: 'Apakah anda yakin ingin menghapus data ini?',
                    icon: "warning",
                    showCancelButton: true,
                    cancelButtonText: "Tidak",
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If the user confirms, redirect to the delete URL
                        window.location.href = deleteUrl;
                    }
                });
            }
        </script>
        <script>
            $(document).ready(function() {

                // Initialize the DataTable
                var table = $('#table-utama').DataTable({
                    dom: '<lf<t>ip>',
                    buttons: [
                        'copy',
                        {
                            extend: 'excelHtml5',
                            title: 'Dharma Nugraha - Daftar User',
                            exportOptions: {
                            columns: [1, 2, 3, 4, 6]
                        }
                        },
                        'colvis'
                    ],
                    scrollX: true,
                    order: [2, 'asc']
                });

                table.buttons().container()
                    .appendTo($('.my-buttons'));
            });
        </script>
    @endsection
