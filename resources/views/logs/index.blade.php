@extends('default')

@section('css')

@endsection

@section('content')
    {{--<select name="model" id="model" class="form-control">--}}
        {{--<option value="0">--Pilih Log--</option>--}}
        {{--@foreach($models as $model)--}}
            {{--<option value="{{ $model }}">{{ $model }}</option>--}}
        {{--@endforeach--}}
    {{--</select>--}}
    {{--<hr>--}}

    <table class="table table-striped table-bordered table-hover" id="table-logs">
        <thead>
        <tr>
            <th>Aktivitas</th>
            <th>Subjek</th>
            <th>User</th>
            <th>Deskripsi</th>
            <th>Waktu</th>
        </tr>
        </thead>
    </table>

@endsection

@section('js')
    <script>
        $(document).ready(function(){
            var table1 = $('#table-logs').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    url: "{{ route('logs.index') }}",
                    "data": function ( d ) {
                        d.id = $('#model').val();
                    }
                },
                "columns": [
                    {data: 'description'},
                    {data: 'subject'},
                    {data: 'causer'},
                    {data: 'desc'},
                    {data: 'created_at'},
                ],
                "responsive" : true,
            });

            $('#model').change(function() {
                table1.ajax.reload();
            });

//            $('#model').select2();
        });
    </script>
@endsection
