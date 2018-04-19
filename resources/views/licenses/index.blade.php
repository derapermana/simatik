@extends('default')

@section('css')

@endsection

@section('content')
    @can('license.a')
    <a href="{{ route('licenses.add') }}" class="btn btn-circle btn-primary">Tambah</a>
    <hr>
    @endcan
    @if (\App\Institution::isCurrentUserAuthorized())
        <select name="institution_id" id="institution_id" class="form-control">
            <option value="9999">--Pilih Unit Utama/ Satuan Kerja--</option>
            @foreach($all_institutions as $institution)
                <option value="{{ $institution->id }}">{{ $institution->name }}</option>
            @endforeach
        </select>
        <hr>
    @endif
    <table class="table table-striped table-bordered table-hover" id="table-licenses">
        <thead>
            <tr>
                @if (\App\Institution::isCurrentUserAuthorized())
                <th>Unit Kerja</th>
                @endif
                <th>Nama</th>
                <th>Tipe</th>
                <th>Manufaktur</th>
                <th>Distributor</th>
                <th>Tanggal Aktif</th>
                <th>Tanggal Berakhir</th>
                <th>Jumlah</th>
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
					<h4 class="modal-title">Hapus Pengelola TIK</h4>
				</div>
                <form method="post" action="{{ route('licenses.delete') }}">
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
        var table1 = $('#table-licenses').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "{{ route('licenses.index') }}",
                "data": function ( d ) {
                    d.id = $('#institution_id').val();
                }
            },
            "columns": [
            @if (\App\Institution::isCurrentUserAuthorized())
            {data: 'institution'},
            @endif
            {data: 'name'},
            {data: 'type'},
            {data: 'manufacture'},
            {data: 'distributor'},
            {data: 'active_term'},
            {data: 'end_term'},
            {data: 'qty'},
            {data: 'action'},
        ],
            "responsive" : true,
        });

        $('#institution_id').change(function() {
            table1.ajax.reload();
        });

        $(document).on("click", ".btn-delete", function () {
          var id = $(this).data('id');
          $(".modal-delete #id-delete").val( id );
        });

        $('#institution_id').select2();
    });
    </script>
@endsection
