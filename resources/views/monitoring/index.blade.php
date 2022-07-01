@extends('layouts')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header">
            <a href="{{ route('project.create') }}" class="btn btn-primary">Create</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>PROJECT NAME</th>
                            <th>CLIENT</th>
                            <th>PROJECT LEADER</th>
                            <th>START DATE</th>
                            <th>END DATE</th>
                            <th>PROGRESS</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
            var table = $('.dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('project.index') }}",
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'client',
                        name: 'client'
                    },
                    {
                        data: 'leader',
                        name: 'leader'
                    },
                    {
                        data: 'start',
                        name: 'start'
                    },
                    {
                        data: 'end',
                        name: 'end'
                    },
                    {
                        data: 'progress',
                        name: 'progress'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        sortable: false
                    },
                ]
            });

               //ajax delete
        function Delete(id) {
            var id = id;
            var token = $("meta[name='csrf-token']").attr("content");

            swal({
                title: "ARE YOU SURE ?",
                text: "WANT TO DELETE THIS PROJECT!",
                icon: "warning",
                buttons: [
                    'No',
                    'Yes'
                ],
                dangerMode: true,
            }).then(function(isConfirm) {
                if (isConfirm) {

                    //ajax delete
                    jQuery.ajax({
                        url: "/project/" + id,
                        data: {
                            "id": id,
                            "_token": token
                        },
                        type: 'DELETE',
                        success: function(response) {
                            if (response.status == "success") {
                                swal({
                                    title: 'SUCCESS!',
                                    text: 'PROJECT REMOVED SUCCESSFULLY!',
                                    icon: 'success',
                                    timer: 1000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    table.ajax.reload();
                                });
                            } else {
                                swal({
                                    title: 'GAGAL!',
                                    text: 'PROJECT FAILED TO DELETE',
                                    icon: 'error',
                                    timer: 1000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    table.ajax.reload();
                                });
                            }
                        }
                    });

                } else {
                    return true;
                }
            })
        }
    </script>
@endpush
