<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Добавить инвентарь</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>

<body class="login-page">
    <div class="login-box mb-1">
        <div class="login-logo">
        <p>
            <a href="/" class="fa-solid fa-house-circle-check"></a>
        </p>
            Добавить инвентарь
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

        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Заполните поля - </p>
                <form action="{{ route('inventories.store') }}" method="POST">
                    @csrf

                    <div class="input-group mb-3">
                        <input name="name" type="name" class="form-control" placeholder="Наименование" value="{{ old('name') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-solid fa-boxes-stacked"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input name="interior_number" type="interior_number" class="form-control"
                            placeholder="Инвентарный номер" value="{{ old('interior_number') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-solid fa-arrow-down-1-9"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input name="invoice" type="invoice" class="form-control" placeholder="Номер накладной/счета"
                            value="{{ old('invoice') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-solid fa-file-invoice"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input name="delivery_note" type="delivery_note" class="form-control" placeholder="ТТН" value="{{ old('delivery_note') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-solid fa-truck"></span>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="form-group">
                        <label>Страна - </label>
                        <select name="country_id" class="form-control select2bs4" style="width: 100%;">
                            @if (isset($user->countries->first()->id))
                                <option selected="selected" value="{{ $user->countries->first()->id }}">
                                    {{ $user->countries->first()->name }}</option>
                            @else
                                <option value="">None</option>
                            @endif
                            @foreach ($user->countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div> --}}

                    <div class="form-group">
                        <label>Компания - </label>
                        <select name="company_id" class="form-control select2bs4" style="width: 100%;">
                            @if (isset($user->companies->first()->id))
                                <option selected="selected" value="{{ $user->companies->first()->id }}">
                                    {{ $user->companies->first()->name }}</option>
                            @else
                                <option value="">None</option>
                            @endif
                            @foreach ($user->companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Город - </label>
                        <select name="city_id" class="form-control select2bs4" style="width: 100%;">
                            @if (isset($user->cities))
                                <option selected="selected" value="{{ $user->cities->first()->id }}">
                                    {{ $user->cities->first()->name }}</option>
                            @else
                                <option value="">None</option>
                            @endif
                            @foreach ($user->cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Офис - </label>
                        <select name="office_id" class="form-control select2bs4" style="width: 100%;">
                            @if (isset($user->offices->first()->id))
                                <option selected="selected" value="{{ $user->offices->first()->id }}">
                                    {{ $user->offices->first()->name }}</option>
                            @else
                                <option value="">None</option>
                            @endif
                            @foreach ($user->offices as $office)
                                <option value="{{ $office->id }}">{{ $office->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <hr>
                    <div class="row">
                        <!-- /.col -->
                        <button type="submit" class="btn btn-primary btn-block mb-1">Добавить</button>
                        <input name="user_id" type="hidden" class="invisible" value="{{ Auth::user()->id }}">
                        <input name="condition_id" type="hidden" class="invisible" value="{{ 1 }}">
                        <input name="country_id" type="hidden" class="invisible" value="{{ $user->countries->first()->id }}">
                        <!-- /.col -->
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- FontAwesome App -->
    <script src="https://kit.fontawesome.com/4a2030a90b.js" crossorigin="anonymous"></script>


</body>

</html>
