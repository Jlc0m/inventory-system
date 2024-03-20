@extends('/layouts/main')

@section('title-page')
   {{ $stock->name }}
@endsection

@section('head-section-main')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('heder-content-main')
    stock - {{ $stock->name }} update
@endsection

@section('content-main')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <div class="card card-info">
                        <div class="card-header">
                        </div>
                        <form class="card-body" action="{{ route('stocks.update', $stock->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
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
                                <label for="stock_name">Name - *</label>
                                <input type="stock_name" class="form-control" name="name" placeholder="Enter name stock" value="{{ $stock->name }}">
                            </div>

                            <div class="form-group">
                                <label>Country - *</label>
                                <select name="country_id" class="form-control select2bs4" style="width: 100%;">
                                    <option selected="selected" value="{{ $stock->country_id }}">{{ $stock->country->name }}</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Company - *</label>
                                <select name="company_id" class="form-control select2bs4" style="width: 100%;">
                                    <option selected="selected" value="{{ $stock->company_id }}">{{ $stock->company->name }}</option>
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>City - *</label>
                                <select name="city_id" class="form-control select2bs4" style="width: 100%;">
                                    <option selected="selected" value="{{ $stock->city_id }}">{{ $stock->city->name }}</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Office - *</label>
                                <select name="office_id" class="form-control select2bs4" style="width: 100%;">
                                    @if (isset($stock->office_id))
                                    <option selected="selected" value="{{ $stock->office_id }}">{{ $stock->office->name }}</option> @else <option value="">none</option> @endif
                                    @foreach ($offices as $office)
                                        <option value="{{ $office->id }}">{{ $office->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="description">Description - </label>
                                <textarea type="description" class="form-control" name="description" placeholder="Enter description stock">{{ $stock->description }}</textarea>
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
