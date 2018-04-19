@extends('default')

@section('css')

@endsection

@section('content')
    @can('user.a')
    <a href="{{ route('users.add') }}" class="btn btn-circle btn-primary">Tambah</a>
    <hr>
    @endcan
    <table class="table table-striped table-bordered table-hover" id="table-users">
        <thead>
            <tr>
                <th>Unit Kerja</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Is Active</th>
                <th>Last Login</th>
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
					<h4 class="modal-title">Hapus User</h4>
				</div>
                <form method="post" action="{{ route('users.delete') }}">
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
        $('#table-users').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('users.index') }}",
            "columns": [
            {data: 'institution'},
            {data: 'name'},
            {data: 'email'},
            {data: 'isactive'},
            {data: 'lastlogin'},
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
