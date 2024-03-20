@extends('/layouts/main')

@section('title-page')
    {{ $inventory->name }}
@endsection

@section('head-section-main')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('heder-content-main')
    {{ $inventory->name }}
@endsection



@section('content-main')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-info">
                        <div class="card-header"></div>
                        <div class="card-body">

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

                            <h3 class="mb-4 mt-0">Main focus - </h3>

                            <form action="{{ route('inventories.update', $inventory->id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <div class="row">
                                    <div class="form-group col-sm-4 mb-3">
                                        <label class="form-label">Interior number</label>
                                        <input @cannot('edit-interior_number')
                                        disabled
                                        @endcannot 
                                        type="text" class="form-control" name="interior_number"
                                            @if (isset($inventory->interior_number)) value="{{ $inventory->interior_number }}"
                                @else
                                placeholder="No interiors number available" @endif>
                                    </div>

                                    <div class="form-group col-sm-4 mb-3">
                                        <label class="form-label">External number</label>
                                        <input @cannot('edit-external_number')
                                        disabled
                                        @endcannot
                                        type="text" class="form-control" name="external_number"
                                            @if (isset($inventory->external_number)) value="{{ $inventory->external_number }}"
                                @else
                                placeholder="No external number available" @endif>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Name</label>
                                        <input @cannot('edit-name')
                                        disabled
                                        @endcannot
                                        name="name" type="text" class="form-control" placeholder="Name"
                                            value="{{ $inventory->name }}">
                                    </div>

                                    <div class="form-group col-md-3 mb-3">
                                        <label class="form-label">Category</label>
                                        <select @cannot('edit-category')
                                        disabled
                                        @endcannot
                                        name="category_id" class="form-control select2bs4" style="width: 100%;">
                                            @if (isset($inventory->category_id))
                                                <option value="{{ $inventory->category_id }}">
                                                    {{ $inventory->category->name }}</option>
                                            @else
                                                <option value="">None</option>
                                            @endif
                                            @foreach ($categories as $category)
                                                <option
                                                    {{ is_array(old('category_id')) && in_array($category->id, old('category_id')) ? 'selected' : '' }}
                                                    value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3 mb-3">
                                        <label class="form-label">Condition</label>
                                        <select @cannot('edit-condition')
                                        disabled
                                        @endcannot
                                        name="condition_id" class="form-control select2bs4" style="width: 100%;">
                                            @if (isset($inventory->condition->id))
                                                <option value="{{ $inventory->condition->id }}">
                                                    {{ $inventory->condition->name }}</option>
                                            @else
                                                <option value="">None</option>
                                            @endif
                                            @foreach ($conditions as $condition)
                                                <option
                                                    {{ is_array(old('condition_id')) && in_array($condition->id, old('condition_id')) ? 'selected' : '' }}
                                                    value="{{ $condition->id }}">{{ $condition->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2 mb-3">
                                        <label class="form-label">Department</label>
                                        <select @cannot('edit-department')
                                        disabled
                                        @endcannot
                                        name="department_id" class="form-control select2bs4" style="width: 100%;">
                                            @if (isset($inventory->department->id))
                                                <option value="{{ $inventory->department->id }}">
                                                    {{ $inventory->department->name }}</option>
                                            @else
                                                <option value="">None</option>
                                            @endif
                                            @foreach ($departments as $department)
                                                <option
                                                    {{ is_array(old('department_id')) && in_array($department->id, old('department_id')) ? 'selected' : '' }}
                                                    value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <hr>

                                <h3 class="mb-4 mt-0">Location - </h3>

                                <div class="row">

                                    <div class="form-group col-md-3 mb-3">
                                        <label class="form-label">Country -</label>
                                        <select @cannot('edit-country')
                                        disabled
                                        @endcannot
                                        name="country_id" class="form-control select2bs4" style="width: 100%;">
                                            @if (isset($inventory->country_id))
                                                <option value="{{ $inventory->country->id }}">
                                                    {{ $inventory->country->name }}</option>
                                            @else
                                                <option value="">None</option>
                                            @endif
                                            @foreach ($user->countries as $country)
                                                <option
                                                    {{ is_array(old('country_id')) && in_array($country->id, old('country_id')) ? 'selected' : '' }}
                                                    value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3 mb-3">
                                        <label class="form-label">Company -</label>
                                        <select @cannot('edit-company')
                                        disabled
                                        @endcannot
                                        name="company_id" class="form-control select2bs4" style="width: 100%;">
                                            @if (isset($inventory->company_id))
                                                <option value="{{ $inventory->company->id }}">
                                                    {{ $inventory->company->name }}</option>
                                            @else
                                                <option value="">None</option>
                                            @endif
                                            @foreach ($user->companies as $company)
                                                <option
                                                    {{ is_array(old('company_id')) && in_array($country->id, old('company_id')) ? 'selected' : '' }}
                                                    value="{{ $company->id }}">{{ $company->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3 mb-3">
                                        <label class="form-label">City -</label>
                                        <select @cannot('edit-city')
                                        disabled
                                        @endcannot
                                        name="city_id" class="form-control select2bs4" style="width: 100%;">
                                            @if (isset($inventory->city_id))
                                                <option value="{{ $inventory->city->id }}">{{ $inventory->city->name }}
                                                </option>
                                            @else
                                                <option value="">None</option>
                                            @endif
                                            @foreach ($user->cities as $city)
                                                <option
                                                    {{ is_array(old('city_id')) && in_array($city->id, old('city_id')) ? 'selected' : '' }}
                                                    value="{{ $city->id }}">{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4 mb-3">
                                        <label class="form-label">Office -</label>
                                        <select @cannot('edit-office')
                                        disabled
                                        @endcannot
                                        name="office_id" class="form-control select2bs4" style="width: 100%;">
                                            @if (isset($inventory->office_id))
                                                <option value="{{ $inventory->office->id }}">
                                                    {{ $inventory->office->name }}</option>
                                            @else
                                                <option value="">None</option>
                                            @endif
                                            @foreach ($user->offices as $office)
                                                <option
                                                    {{ is_array(old('office_id')) && in_array($office->id, old('office_id')) ? 'selected' : '' }}
                                                    value="{{ $office->id }}">{{ $office->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4 mb-3">
                                        <label class="form-label">Stock -</label>
                                        <select @cannot('edit-stock')
                                        disabled
                                        @endcannot
                                        name="stock_id" class="form-control select2bs4" style="width: 100%;">
                                            @if (isset($inventory->stock->id))
                                                <option value="{{ $inventory->stock->id }}">
                                                    {{ $inventory->stock->name }}</option>
                                            @else
                                                <option value="">None</option>
                                            @endif
                                            @foreach ($user->cities as $city)
                                                @foreach ($city->stocks as $stock)
                                                    <option
                                                        {{ is_array(old('stock_id')) && in_array($stock->id, old('stock_id')) ? 'selected' : '' }}
                                                        value="{{ $stock->id }}">{{ $stock->name }}</option>
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <hr>

                                <h3 class="mb-4 mt-0">Description - </h3>

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Invoice number:</label>
                                        <input @cannot('edit-invoice')
                                        disabled
                                        @endcannot
                                        type="text" class="form-control" name="invoice"
                                            @if (isset($inventory->invoice)) value="{{ $inventory->invoice }}"
                                @else
                                placeholder="None invoice number:" @endif>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Delivery note:</label>
                                        <input @cannot('edit-delivery_note')
                                        disabled
                                        @endcannot
                                        type="text" class="form-control" name="delivery_note"
                                            @if (isset($inventory->delivery_note)) value="{{ $inventory->delivery_note }}"
                                @else
                                placeholder="None delivery note:" @endif>
                                    </div>

                                    <div class="col-sm-8 mb-3">
                                        <label class="form-label">Description:</label>
                                        <textarea type="text" class="form-control" name="description"
                                            @if (isset($inventory->description)) value="{{ $inventory->description }}"
                                        @else
                                        placeholder="No description available" @endif>{{ $inventory->description }}</textarea>
                                    </div>
                                </div>

                                <hr>

                                <button @cannot('edit-inventory')
                                disabled
                                @endcannot
                                type="submit" class="btn btn-block btn-outline-primary col-sm-4">Edit</button>

                            </form>
                            {{-- /.form --}}
                        </div>
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













{{-- <div class="form-group">
    <label>Склад - </label>
    <select name="country_id" class="form-control select2bs4" style="width: 100%;">
        
        @foreach ($user->cities as $city)
        
                @foreach ($city->stocks as $stock)
            <option value="{{ $stock->id }}">{{ $stock->name }}</option>
                @endforeach

                @endforeach
        
    </select>
</div> --}}
