@extends('default')

@section('css')

@endsection

@section('content')
    @can('ip_address.a')
    <a href="{{ route('ip_addresses.add') }}" class="btn btn-circle btn-primary">Tambah</a>
    <hr>
    @endcan
    <table class="table table-striped table-bordered table-hover" id="table-ip_addresses">
        <thead>
        <tr>
            @if (\App\Institution::isCurrentUserAuthorized())
                <th>Unit Kerja</th>
            @endif
            <th>IP Address</th>
            <th>Catatan</th>
            <th></th>
        </tr>
        </thead>
    </table>

    <!-- /.modal -->
    <div class="modal fade bs-modal-sm modal-delete" id="modalDelete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Hapus IP Address</h4>
                </div>
                <form method="post" action="{{ route('ip_addresses.delete') }}">
                    @csrf
                    <input type="hidden" name="id" id="id-delete">
                    <div class="modal-body">
                        Yakin ingin menghapus?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn blue">Ya</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $('#table-ip_addresses').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('ip_addresses.index') }}",
                "columns": [
                        @if (\App\Institution::isCurrentUserAuthorized())
                    {data: 'institution'},
                        @endif
                    {data: 'ip_address'},
                    {data: 'notes'},
                    {data: 'action'},
                ],
                "responsive" : true,
            });

            $(document).on("click", ".btn-delete", function () {
                var id = $(this).data('id');
                $(".modal-delete #id-delete").val( id );
            });
        });
    </script>
@endsection
