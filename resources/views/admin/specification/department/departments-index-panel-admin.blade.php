@extends('/layouts/main')

@section('title-page')
    department settings
@endsection

@section('heder-content-main')
    department settings
@endsection

@section('content-main')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header d-flex justify-content-end">
                            <a href="{{ route('departments.create') }}" type="button"
                                class="btn btn-block btn-outline-success col-md-3">Add department</a>
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
                                    @foreach ($departments as $department)
                                        <tr>
                                            <td>{{ $department->id }}</td>
                                            <td>{{ $department->name }}</td>
                                            <td style="width: 40px">
                                                <div class="btn-group">
                                                    <a href="#" type="button" class="btn btn-success">edit</a>
                                                    <form action="{{ route('departments.destroy', $department->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">delete</button>
                                                    </form>
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
                                {{ $departments->withQueryString()->links() }}
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
