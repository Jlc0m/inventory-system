@extends('/layouts/main')

@section('title-page')
{{ $inventory->name }}
@endsection

@section('head-section-main')
@endsection

@section('heder-content-main')
{{ $inventory->interior_number }} "{{ $inventory->name }}" - Update Log
@endsection

@section('content-main')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
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
                        <div class="card-body">
                            <ul>
                                @forelse ($audits as $audit)
                                <li class="border border-primary rounded">
                                    @lang('updatelog.updated.metadata', $audit->getMetadata())
                            
                                    @foreach ($audit->getModified() as $attribute => $modified)
                                    <ul>
                                        <li class="container">@lang('updatelog.'.$audit->event.'.modified.'.$attribute, $modified)</li>
                                    </ul>
                                    @endforeach
                                </li>
                                @empty
                                <p>@lang('updatelog.unavailable_audits')</p>
                                @endforelse
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection

