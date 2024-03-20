@extends('/layouts/main')

@section('title-page')
    department - create
@endsection

@section('heder-content-main')
    department - create
@endsection

@section('content-main')
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-6">

                    <div class="card card-info">
                        <div class="card-header">
                        </div>

                        <form class="card-body" action="{{ route('departments.store') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="mb-3 border-bottom">
                                <h4> Main data - </4>
                            </div>
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
                            <div class="form-group">
                                <label for="department_name">Name - </label>
                                <input type="department_name" class="form-control" name="name"
                                    placeholder="Enter name department">
                            </div>

                            <hr>

                            <button type="submit" class="btn btn-block btn-outline-success">Submit</button>
                            <!-- /.card-body-form -->
                        </form>

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
    </section>
@endsection
