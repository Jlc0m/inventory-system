@extends('/layouts/main')

@section('title-page')
    {{ $user->name }}
@endsection

@section('head-section-main')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('heder-content-main')
    User edit - {{ $user->name }}
@endsection

@section('content-main')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">

                    <div class="card card-info">
                        <div class="card-header">
                          
                        </div>
                        <form class="card-body" action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

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

                            <div class="mb-3 border-bottom">
                                <h4> Personal data - </4>
                                </div>

                            <div class="form-group">
                                <label for="name">Name - </label>
                                <input  type="name" class="form-control" name="name" placeholder="Enter name" value="{{ $user->name }}">
                              </div>
                              <div class="form-group">
                                <label for="email">Email - </label>
                                <input type="email" class="form-control" name="email" placeholder="Enter email" value="{{ $user->email }}">
                              </div>
                              <div class="form-group">
                                <label for="password">Password - </label>
                                <input disabled type="password" class="form-control" id="password" placeholder="Enter password" value="{{ $user->password }}">
                              </div>

                              <div class="mb-3 border-bottom">
                             <h4> Location - </4>
                            </div>
                            
                            <div class="form-group" data-select2-id="1">
                              <label>Country - *</label>
                              <div class="select2-purple" data-select2-id="1">
                                <select name="country_ids[]" class="select2 select2-hidden-accessible" multiple="" data-placeholder="Select a Country" data-dropdown-css-class="select2-purple" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                  @foreach ($countries as $country)
                                      <option @if ($user->countries->where('id', $country->id)->count()) selected="selected" @endif {{ is_array(old('country_ids')) && in_array($country->id, old('country_ids')) ? 'selected' : '' }} value="{{ $country->id }}">{{ $country->name }}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>

                            <div class="form-group" data-select2-id="2">
                              <label>Company - *</label>
                              <div class="select2-purple" data-select2-id="2">
                                <select name="company_ids[]" class="select2 select2-hidden-accessible" multiple="" data-placeholder="Select a Company" data-dropdown-css-class="select2-purple" style="width: 100%;" data-select2-id="2" tabindex="-1" aria-hidden="true">
                                  @foreach ($companies as $company)
                                      <option @if ($user->companies->where('id', $company->id)->count()) selected="selected" @endif {{ is_array(old('company_ids')) && in_array($company->id, old('company_ids')) ? 'selected' : '' }} value="{{ $company->id }}">{{ $company->name }}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>

                            <div class="form-group" data-select2-id="3">
                              <label>City - *</label>
                              <div class="select2-purple" data-select2-id="3">
                                <select name="city_ids[]" class="select2 select2-hidden-accessible" multiple="" data-placeholder="Select a City" data-dropdown-css-class="select2-purple" style="width: 100%;" data-select2-id="3" tabindex="-1" aria-hidden="true">
                                  @foreach ($cities as $city)
                                      <option @if ($user->cities->where('id', $city->id)->count()) selected="selected" @endif {{ is_array(old('city_ids')) && in_array($city->id, old('city_ids')) ? 'selected' : '' }} value="{{ $city->id }}">{{ $city->name }}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>

                            <div class="form-group" data-select2-id="4">
                              <label>Office - *</label>
                              <div class="select2-purple" data-select2-id="4">
                                <select name="office_ids[]" class="select2 select2-hidden-accessible" multiple="" data-placeholder="Select a Office" data-dropdown-css-class="select2-purple" style="width: 100%;" data-select2-id="4" tabindex="-1" aria-hidden="true">
                                  @foreach ($offices as $office)
                                      <option @if ($user->offices->where('id', $office->id)->count()) selected="selected" @endif {{ is_array(old('office_ids')) && in_array($office->id, old('office_ids')) ? 'selected' : '' }} value="{{ $office->id }}">{{ $office->name }}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>

                              <div class="mb-3 border-bottom">
                                <h4> Other - </4>
                               </div>

                               <label class="form-label">Role - </label>
                                    <select name="role_id" class="form-control select2bs4" style="width: 100%;">
                                      <option value="">none</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role['id'] }}"
                                                @if ($user->hasRole($role['name'])) selected @endif>{{ $role['name'] }}
                                            </option>
                                        @endforeach
                                    </select>

                               <div class="form-group">
                                <label>Department - </label>
                                <select class="form-control select2bs4" style="width: 100%;">
                                  <option selected="selected">Alabama</option>
                                  <option>Alaska</option>
                                </select>
                              </div>

                              <div class="form-group">
                                <label>Condition - </label>
                                <select class="form-control select2bs4" style="width: 100%;">
                                  <option selected="selected">Alabama</option>
                                  <option>Alaska</option>
                                </select>
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
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
  
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    })
  </script>
@endsection