@extends('/layouts/main')

@section('title-page')
    office settings
@endsection

@section('heder-content-main')
    office settings
@endsection

@section('content-main')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header d-flex justify-content-end">
                            <a href="{{ route('offices.create') }}" type="button"
                                class="btn btn-block btn-outline-success col-md-3">Add office</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">Id</th>
                                        <th>Name</th>
                                        <th style="width: 40px">Edit/delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($offices as $office)
                                        <tr>
                                            <td>{{ $office->id }}</td>
                                            <td>{{ $office->name }}</td>
                                            <td style="width: 40px">
                                                <div class="btn-group">
                                                    <a href="{{ route('offices.edit', $office->id) }}" type="button" class="btn btn-success">edit</a>
                                                    <a href="#" type="button" class="btn btn-danger">delete</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                {{ $offices->withQueryString()->links() }}
                            </ul>
                        </div>
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
