@extends('/layouts/main')

@section('title-page')
    Добавление малоценки
@endsection

@section('head-section-main')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('heder-content-main')
    Добавление малоценных товаров
@endsection

@section('content-main')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-info">
                        <div class="card-header"></div>

                        <form action="{{ route('small-price-inventory.store') }}" method="POST"
                            enctype="multipart/form-data" class="p-2">
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
                                <label for="gender">Категория товара</label>
                                <select class="form-control select2" name="category_small_price_inventory_id[]"
                                    style="width: 100%;">';
                                    @foreach ($categories as $category)
                                        <option value=""></option>
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <input name="name[]" value="name" hidden>

                                <label for="quantity">Количество</label>
                                <input type="quantity" class="form-control" name="quantity[]">

                            </div>
                            
                            <div id="add-more">
                                <button type="button" class="btn btn-primary mb-3" onclick="addMore()">Добавить поле</button>
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

                            <div class="form-group">
                                <label for="file">Накладная</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="file" name="file">
                                    <label class="custom-file-label" for="file" capture="camera">Выберите файл</label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Відправити</button>
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
    <script src="https://getbootstrap.com/docs/4.5/assets/js/docs.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap4'
            });
        });

        function addMore() {
            var html = '<div class="form-group">';

            html += '<label for="gender">Категория товара</label>';
            html += '<select class="form-control select2" name="category_small_price_inventory_id[]" style="width: 100%;">';
            html +=
                `@foreach ($categories as $category)' <option value="{{ $category->id }}">{{ $category->name }}</option> @endforeach`
            html += '</select>';
            html += '<input name="name[]" value="name" hidden>'

            html += '<label for="quantity">Количество</label>';
            html += '<input type="quantity" class="form-control" name="quantity[]">';

            html += '<button type="button" class="btn btn-block btn-danger mt-2" onclick="removeField(this)">Видалити</button>';
            html += '<hr>';
            html += '</div>';


            $('#add-more').before(html);
            $('.select2').select2(); // ініціалізація поля
        }

        function removeField(button) {
            $(button).closest('.form-group').remove();
        }
    </script>
@endsection
