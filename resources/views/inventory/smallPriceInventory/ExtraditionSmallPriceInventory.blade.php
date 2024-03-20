@extends('/layouts/main')

@section('title-page')
    Выдача малоценных товаров
@endsection

@section('head-section-main')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('heder-content-main')
    Выдача малоценных товаров
@endsection

@section('content-main')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <div class="card card-info">
                        <div class="card-header">
                        </div>
                        <form action="{{ route('extradition') }}" method="POST" class="p-2">
                            @csrf
                            @method('POST')
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
                                <label for="category_small_price_inventory_id">Категория товара</label>
                                <select class="form-control select2" name="category_small_price_inventory_id[]"
                                    style="width: 100%;">';
                                    <option value=""></option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <input name="name[]" value="name" hidden>

                                <label for="quantity">Количество</label>
                                <input type="quantity" class="form-control" name="quantity[]">

                            </div>

                            <label>Выберите Вашу компанию - *</label>
                            <select name="company_id" class="form-control select2 col-4" style="width: 100%;">
                                @foreach ($user->companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                            <label>Выберите Ваш город - *</label>
                            <select name="city_id" class="form-control select2 col-4" style="width: 100%;">
                                @foreach ($user->cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>

                            <label>Выберите Ваш офис - *</label>
                            <select name="office_id" class="form-control select2 col-4" style="width: 100%;">
                                @foreach ($user->offices as $office)
                                    <option value="{{ $office->id }}">{{ $office->name }}</option>
                                @endforeach
                            </select>

                            <label>Выберите Ваш склад - *</label>
                            <select name="stock_id" class="form-control select2 col-4" style="width: 100%;">
                                @foreach ($user->cities as $city)
                                    @foreach ($city->stocks as $stock)
                                        <option value="{{ $stock->id }}">{{ $stock->name }}</option>
                                    @endforeach
                                @endforeach
                            </select>

                            <button type="submit" class="btn btn-primary">Подтвердить</button>
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
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap4'
            });
        });
    </script>
@endsection
