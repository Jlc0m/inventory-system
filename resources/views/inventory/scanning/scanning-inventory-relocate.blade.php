@extends('/layouts/main')

@section('title-page')
    Релокация инвентаря
@endsection

@section('head-section-main')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('heder-content-main')
    Релокация инвентаря
@endsection

@section('content-main')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-info">
                        <div class="card-header mb-2 bg-warning">
                            <button id="start-scan-btn" type="button" class="btn btn-success col-md-2 m-2">Начать сканирование</button>
                            <button id="stop-scan-btn" class="btn btn-danger col-md-2 m-2">Остановить</button>
                        </div>

                        <video id="scanner" style="width: 100%; height: 400px;"></video>

                        <form action="{{ route('scan-inventories-relocate-post') }}" method="POST" class="p-2">
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

                            <div id="scanned-codes-container" class="bg-light p-2 rounded"></div>

                            <div class="p-2">
                                <label class="mt-2">Выберите компанию отправитель - *</label>
                                <select name="sender_company_id" class="form-control select2 col-md-4">
                                    <option value="">Выберите компанию</option>
                                    @foreach ($user->companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select>
                                <label class="mt-2">Выберите город отправитель - *</label>
                                <select name="sender_city_id" class="form-control select2 col-md-4">
                                    <option value="">Выберите город</option>
                                    @foreach ($user->cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                                <label class="mt-2">Выберите офис отправитель - *</label>
                                <select name="sender_office_id" class="form-control select2 col-md-4">
                                    <option value="">Выберите офис</option>
                                    @foreach ($user->offices as $office)
                                        <option value="{{ $office->id }}">{{ $office->name }}</option>
                                    @endforeach
                                </select>

                                <hr class="mt-3">

                                <label class="mt-2">Выберите компанию получателя - *</label>
                                <select name="recipient_company_id" class="form-control select2 col-md-4">
                                    <option value="">Выберите компанию</option>
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select>

                                <label class="">Выберите город получателя - *</label>
                                <select name="recipient_city_id" class="form-control select2 col-md-4">
                                    <option value="">Выберите город</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>

                                <label class="mt-2">Выберите офис получателя - *</label>
                                <select name="recipient_office_id" class="form-control select2 col-md-4">
                                    <option value="">Выберите офис</option>
                                    @foreach ($offices as $office)
                                        <option value="{{ $office->id }}">{{ $office->name }}</option>
                                    @endforeach
                                </select>

                                <label class="mt-2">Выберите получателя - *</label>
                                <select name="recipient_user_id" class="form-control select2 col-md-4">
                                        <option value="">Выберите получателя</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>

                                <button type="submit" class="btn btn-primary mt-3">Отправить</button>
                            </div>
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
    <script src="{{ asset('dist/js/zxing.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap4'
            });
        });

        let codeReader = null;
        const scannedCodes = [];

        function initCodeReader() {
            if (!codeReader) {
                codeReader = new ZXing.BrowserMultiFormatReader();
            }
        };

        function startScanning() {
            initCodeReader();
            codeReader
                .decodeFromInputVideoDevice(undefined, 'scanner')
                .then(result => {
                    if (!scannedCodes.includes(result.text)) {
                        scannedCodes.push(result.text);
                        const container = $('#scanned-codes-container');
                        let resultCode = result.text.match(/\[(.*?)\]/)[1];
                        let newElements = `
                        <div class="mb-2" data-index="${scannedCodes.length - 1}">
                        <label>Inventory scanned code:</label>
                        <input class="form-control col-md-4 mb-2" type="text" name="inventory_number_to_itams[]" value="${resultCode}">
                        <button type="button" class="btn btn-danger col-md-2 btn-sm mt-2 delete-btn">Delete</button>
                        <hr>
                        </div>`;
                        container.append(newElements);
                        container.find('select').select2();
                        container.find('.delete-btn:last').on('click', function(e) {
                            const parent = $(this).closest('[data-index]');
                            const index = parent.data('index');
                            scannedCodes.splice(index, 1);
                            parent.remove();
                        });
                        stopScanning(); // останавливаем сканер
                        startScanning(); // запускаем сканер снова
                    } else {
                        alert('Code already scanned: ' + result.text);
                        stopScanning(); // останавливаем сканер
                        startScanning(); // запускаем сканер снова
                    }
                }).catch(err => {
                    alert('Перезагрузите страницу произошла ошибка, если вы просто остановили процесс сканирования игнорируйте данное сообщение: ' + err);
                    stopScanning();
            });
        };

        function stopScanning() {
            if (codeReader) {
                codeReader.reset();
            }
        };

        $('#start-scan-btn, #stop-scan-btn').on('click', function(e) {
            e.preventDefault();
            if (this.id === 'start-scan-btn') {
                startScanning();
            } else {
                stopScanning();
            }
        });

        $('#scanned-codes-container').on('click', '.remove-btn', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            $(`#scanned-codes-container div[data-id=${id}]`).remove();
        });
    </script>
@endsection
