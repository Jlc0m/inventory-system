@extends('/layouts/main')

@section('title-page')
    
@endsection

@section('head-section-main')
@endsection

@section('heder-content-main')
    
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

                            <hr>
                                @foreach ($smallPriceInventory->receiveTransactions as $receiveTransaction)
                                    {{$receiveTransaction->user_id}}
                                    {{$receiveTransaction->company->name}}
                                    {{$receiveTransaction->receiptAccount->path_file_receipt_accounts}}
                                @endforeach
                            <hr>

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
