@extends('/layouts/main')

@section('title-page')
    condition settings
@endsection

@section('heder-content-main')
    condition settings
@endsection

@section('content-main')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header d-flex justify-content-end">
                            <a href="{{ route('conditions.create') }}" type="button"
                                class="btn btn-block btn-outline-success col-md-3">Add condition</a>
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
                                    @foreach ($conditions as $condition)
                                        <tr>
                                            <td>{{ $condition->id }}</td>
                                            <td>{{ $condition->name }}</td>
                                            <td style="width: 40px">
                                                <div class="btn-group">
                                                    <a href="#" type="button" class="btn btn-success">edit</a>
                                                    <form action="{{ route('conditions.destroy', $condition->id) }}" method="POST">
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
                                {{ $conditions->withQueryString()->links() }}
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
