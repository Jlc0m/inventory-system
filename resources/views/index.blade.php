@extends('/layouts/main')

@section('head-section-main')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('title-page')
    jlc0m-system
@endsection

@section('heder-content-main')
    Main page
@endsection


@section('content-main')
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>150</h3>
                            <p>In Stock</p>
                        </div>
                        <div class="icon">
                            <i class="ion fa-solid fa-warehouse"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>53<sup style="font-size: 20px"></sup></h3>

                            <p>In Office</p>
                        </div>
                        <div class="icon">
                            <i class="ion fa-solid fa-building-circle-check"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>44</h3>

                            <p>Free Inventory</p>
                        </div>
                        <div class="icon">
                            <i class="ion fa-brands fa-free-code-camp"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>65</h3>

                            <p>No Distribution</p>
                        </div>
                        <div class="icon">
                            <i class="ion fa-solid fa-circle-xmark"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->

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
                                
                                    <th style="width: 30px">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inventories as $inventory)
                                    <tr>
                                        <td>{{ $inventory->category->name }}</td>
                                        <td><a href="{{ route('inventories.show', $inventory->id) }}">{{ $inventory->inventory_number_to_itams }}</a></td>
                                        <td>{{ $inventory->company->name }}</td>
                                        <td>{{ $inventory->city->name }}</td>
                                        <td @if (isset($inventory->office->id)) class="bg-purple" @endif>
                                            @if (isset($inventory->office->id))
                                                {{ $inventory->office->name }}
                                            @else
                                                None
                                            @endif
                                        </td>
                                        <td @if (isset($inventory->stock->id)) class="bg-primary" @endif>
                                            @if (isset($inventory->stock->id))
                                                {{ $inventory->stock->name }}
                                            @else
                                                None
                                            @endif
                                        </td>
                                        <td @if ($inventory->category == null) class="bg-danger" @endif>
                                            @if (isset($inventory->category->id))
                                                {{ $inventory->category->name }}
                                            @else
                                                None
                                            @endif
                                        </td>
                                        <td @if ($inventory->condition == null) class="bg-danger" @endif>
                                            
                                            @if (isset($inventory->condition->id))
                                                {{ $inventory->condition->name }}
                                            @else
                                                None
                                            @endif
                                        </td>
                                        
                                        <td style="width: 30px">
                                            <div class="btn-group">
                                                <a href="{{ route('inventories.edit', $inventory->id) }}" type="button"
                                                    class="btn btn-success">edit</a>
                                            </div>
                                        </td>
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
                                    <th style="width: 30px">Edit</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
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
                "lengthChange": true,
                "autoWidth": true,
                'select': true,
                'ordering': true,
                "order": [],
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
