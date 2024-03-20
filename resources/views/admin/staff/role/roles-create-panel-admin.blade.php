@extends('/layouts/main')
@section('title-page')
    Role - create
@endsection
@section('head-section-main')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('heder-content-main')
    Role - create
@endsection
@section('content-main')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <div class="card card-info">
                        <div class="card-header">
                        </div>
                        <form class="card-body" action="{{ route('roles.store') }}" method="POST">
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
                                <label for="role_name">Name - </label>
                                <input type="role_name" class="form-control" name="name" placeholder="Enter name role">
                            </div>
                            <div class="form-group" data-select2-id="30">
                                <label>Permissions - *</label>
                                <div class="select2-purple" data-select2-id="30">
                                    <select name="permission_ids[]" class="select2 select2-hidden-accessible" multiple=""
                                        data-placeholder="Select a permissions" data-dropdown-css-class="select2-purple"
                                        style="width: 100%;" data-select2-id="30" tabindex="-1" aria-hidden="true">
                                        @foreach ($permissions as $permission)
                                            <option
                                                {{ is_array(old('permission_ids')) && in_array($city->id, old('permission_ids')) ? 'selected' : '' }}
                                                value="{{ $permission->id }}">{{ $permission->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-block btn-outline-success">Submit</button>
                        </form>
                        <!-- /.card-body-form -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
    </section>
@endsection
@section('js-section-main')
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })
    </script>
@endsection
