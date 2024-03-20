@extends('/layouts/main')

@section('title-page')
    {{ $company->name }}
@endsection

@section('head-section-main')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('heder-content-main')
{{ $company->name }} - edit
@endsection

@section('content-main')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <div class="card card-info">
                        <div class="card-header">
                        </div>
                        <form class="card-body" action="{{ route('companies.update', $company->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
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
                                <label for="company_name">Name - *</label>
                                <input type="company_name" class="form-control" name="name" placeholder="Enter name company" value="{{ $company->name }}">
                            </div>

                            <div class="form-group">
                                <label>Country - *</label>
                                <select name="country_id" class="form-control select2bs4" style="width: 100%;">
                                    <option selected="selected" value="{{ $company->country_id }}">{{ $company->country->name }}</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group" data-select2-id="30">
                                <label>Cities - *</label>
                                <div class="select2-purple" data-select2-id="30">
                                  <select name="city_ids[]" class="select2 select2-hidden-accessible" multiple="" data-placeholder="Select a City" data-dropdown-css-class="select2-purple" style="width: 100%;" data-select2-id="30" tabindex="-1" aria-hidden="true">
                                    @foreach ($cities as $city)
                                        <option @if ($company->cities->where('id', $city->id)->count()) selected="selected" @endif {{ is_array(old('city_ids')) && in_array($city->id, old('city_ids')) ? 'selected' : '' }} value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>

                            <div class="form-group">
                                <label for="address">Address - </label>
                                <input type="address" class="form-control" name="address" placeholder="Enter address company" value="{{ $company->address }}">
                            </div>

                            <div class="form-group">
                                <label for="requisites">Requisites - </label>
                                <textarea type="requisites" class="form-control" name="requisites" placeholder="Enter requisites company">{{ $company->requisites }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="accountant">Accountant - </label>
                                <input type="accountant" class="form-control" name="accountant" placeholder="Enter accountant company" value="{{ $company->accountant }}">
                            </div>

                            <div class="form-group">
                                <label for="taxation">Taxation - </label>
                                <input type="taxation" class="form-control" name="taxation" placeholder="Enter taxation company" value="{{ $company->taxation }}">
                            </div>

                            <div class="form-group">
                                <label for="description">Description - </label>
                                <textarea type="description" class="form-control" name="description" placeholder="Enter description company">{{ $company->description }}</textarea>
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
