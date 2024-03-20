@extends('/layouts/main')

@section('title-page')
    My inventory
@endsection

@section('head-section-main')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('heder-content-main')
    Inventory in
@endsection

@section('content-main')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Наименование</th>
                                        <th>Инвентарный номер</th>
                                        <th>Компания</th>
                                        <th>Город</th>
                                        <th>Офис</th>
                                        <th>Склад</th>
                                        <th>Категория</th>
                                        <th>Состояние</th>
                                        <th>Департамент</th>
                                        <th>Owner</th>
                                        <th style="width: 30px">Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inventories as $inventory)
                                    <tr>
                                        <td>{{ $inventory->name }}</td>
                                        <td><a href="{{ route('inventories.show', $inventory->id) }}">{{ $inventory->interior_number }}</a></td>
                                        <td>{{ $inventory->company->name }}</td>
                                        <td>{{ $inventory->city->name }}</td>
                                        <td @if (isset($inventory->office->id)) class="bg-purple" @endif>@if (isset($inventory->office->id))
                                            {{ $inventory->office->name }}
                                        @else
                                            None
                                        @endif</td>
                                        <td @if (isset($inventory->stock->id)) class="bg-primary" @endif >@if (isset($inventory->stock->id))
                                            {{ $inventory->stock->name }}
                                        @else
                                            None
                                        @endif</td>
                                        <td @if ($inventory->category == null) class="bg-danger" @endif>@if (isset($inventory->category->id))
                                            {{ $inventory->category->name }}
                                        @else
                                            None
                                        @endif</td>
                                        <td @if ($inventory->condition == null) class="bg-danger" @endif @if($inventory->condition->name == 'Used') class="bg-teal" @endif 
                                            @if ($inventory->condition->name == 'In stock') class="bg-orange" @endif 
                                            @if ($inventory->condition->name == 'Broken') class="bg-navy" @endif>
                                            @if (isset($inventory->condition->id))
                                            {{ $inventory->condition->name }}
                                        @else
                                            None
                                        @endif</td>
                                        <td @if ($inventory->department == null) class="bg-danger" @endif>@if (isset($inventory->department->id))
                                            {{ $inventory->department->name }}
                                        @else
                                            None
                                        @endif</td>
                                        <td><a href="#">Owner</a></td>
                                        <td style="width: 30px"><div class="btn-group">
                                            <a href="{{ route('inventories.edit', $inventory->id) }}" type="button" class="btn btn-success">edit</a>
                                        </div></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Наименование</th>
                                        <th>Инвентарный номер</th>
                                        <th>Компания</th>
                                        <th>Город</th>
                                        <th>Офис</th>
                                        <th>Склад</th>
                                        <th>Категория</th>
                                        <th>Состояние</th>
                                        <th>Департамент</th>
                                        <th>Owner</th>
                                        <th style="width: 30px">Edit</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection

@section('js-section-main')
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection


