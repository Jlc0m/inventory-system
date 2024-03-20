@extends('/layouts/main')

@section('title-page')
    {{ $inventory->name }}
@endsection

@section('head-section-main')
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

                            <div class="card card-primary card-outline direct-chat direct-chat-primary shadow-none">
                                <div class="card-header">
                                  <h3 class="card-title">Comment inventory -</h3>
                  
                                  <div class="card-tools">
                                    <span title="3 New Messages" class="badge bg-primary">{{ $inventory->invcomments->count() }}</span>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                      <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                      <i class="fas fa-times"></i>
                                    </button>
                                  </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                  <!-- Conversations are loaded here -->
                                  <div class="direct-chat-messages">
                                    <!-- Message. Default to the left -->
                                    @foreach ($invcomments as $invcomment)
                                    <div class="direct-chat-msg">
                                      <div class="direct-chat-infos clearfix">
                                        <span class="direct-chat-name float-left">{{ $invcomment->user->name }}</span>
                                        <span class="direct-chat-timestamp float-right">{{ $invcomment->created_at }}</span>
                                      </div>
                                      <!-- /.direct-chat-infos -->
                                      <img class="direct-chat-img" src="{{ asset('../dist/img/user1-128x128.jpg') }}" alt="Message User Image">
                                      <!-- /.direct-chat-img -->
                                      <div class="direct-chat-text">
                                        {{ $invcomment->title }}
                                      </div>
                                      <!-- /.direct-chat-text -->
                                    </div>
                                    @endforeach
                                    <!-- /.direct-chat-msg -->
                                  </div>
                                  <!--/.direct-chat-messages-->

                                  <!-- /.direct-chat-pane -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                  <form action="{{ route('invcomment_add')}}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="input-group">
                                        <input type="text" name="title" placeholder="Type Message ..." class="form-control">
                                        <input class="form-control mb-1" type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        <input class="form-control mb-1" type="hidden" name="inventory_id" value="{{ $inventory->id }}">
                                      <span class="input-group-append">
                                        <button type="submit" class="btn btn-primary">Send</button>
                                      </span>
                                    </div>
                                  </form>
                                </div>
                                <!-- /.card-footer-->
                              </div>

                            {{-- <form action="{{ route('invcomment_add')}}" method="POST">
                                @csrf
                                @method('POST')
                                <input class="form-control mb-1" type="text" name="title">
                                <input class="form-control mb-1" type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <input class="form-control mb-1" type="hidden" name="inventory_id" value="{{ $inventory->id }}">
                                <button class="btn btn-block btn-outline-primary col-sm-4" type="submit">add comment</button>
                            </form> --}}

                            <hr>

                            <h3 class="mb-4 mt-0">Main focus - </h3>

                            <div class="row">
                                <div class="form-group col-sm-6 mb-3">
                                    <label class="form-label">Interior number</label>
                                    <input disabled type="text" class="form-control" name="interior_number"
                                        @if (isset($inventory->interior_number)) value="{{ $inventory->interior_number }}"
                                @else
                                placeholder="No interiors number available" @endif>
                                </div>

                                <div class="form-group col-sm-6 mb-3">
                                    <label class="form-label">External number</label>
                                    <input disabled type="text" class="form-control" name="external_number"
                                        id="external_number"
                                        @if (isset($inventory->external_number)) value="{{ $inventory->external_number }}"
                                @else
                                placeholder="No external number available" @endif>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Name</label>
                                    <input disabled type="text" class="form-control" placeholder="Name"
                                        value="{{ $inventory->name }}">
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Category</label>
                                    <div class="input-group has-validation">
                                        <input disabled type="text" class="form-control"
                                            @if (isset($inventory->category)) value="{{ $inventory->category->name }}"
                                @else
                                placeholder="No category available" @endif>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Condition</label>
                                    <div class="input-group has-validation">
                                        <input disabled type="text" class="form-control"
                                            @if (isset($inventory->condition)) value="{{ $inventory->condition->name }}"
                                @else
                                placeholder="No condition available" @endif>
                                    </div>
                                </div>

                                <div class="col-md-2 mb-3">
                                    <label class="form-label">Department</label>
                                    <input disabled type="text" class="form-control"
                                        @if (isset($inventory->department)) value="{{ $inventory->department->name }}"
                                @else
                                placeholder="None" @endif>
                                </div>
                            </div>

                            <hr>

                            <h3 class="mb-4 mt-0">Location - </h3>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Country</label>
                                    <input disabled type="text" class="form-control"
                                        @if (isset($inventory->country)) value="{{ $inventory->country->name }}"
                                @else
                                placeholder="None" @endif>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Company</label>
                                    <input disabled type="text" class="form-control"
                                        @if (isset($inventory->company)) value="{{ $inventory->company->name }}"
                                @else
                                placeholder="None" @endif>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">City</label>
                                    <input disabled type="text" class="form-control"
                                        @if (isset($inventory->city)) value="{{ $inventory->city->name }}"
                                @else
                                placeholder="None" @endif>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Office</label>
                                    <input disabled type="text" class="form-control"
                                        @if (isset($inventory->office)) value="{{ $inventory->office->name }}"
                                @else
                                placeholder="None" @endif>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Stock</label>
                                    <input disabled type="text" class="form-control"
                                        @if (isset($inventory->stock)) value="{{ $inventory->stock->name }}"
                                @else
                                placeholder="None" @endif>
                                </div>
                            </div>

                            <hr>

                            <h3 class="mb-4 mt-0">Description - </h3>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Invoice number:</label>
                                    <input disabled type="text" class="form-control"
                                        @if (isset($inventory->invoice)) value="{{ $inventory->invoice }}"
                                @else
                                placeholder="None" @endif>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Delivery note:</label>
                                    <input disabled type="text" class="form-control"
                                        @if (isset($inventory->delivery_note)) value="{{ $inventory->delivery_note }}"
                                @else
                                placeholder="None" @endif>
                                </div>

                                <div class="col-sm-8 mb-3">
                                    <label class="form-label">Description:</label>
                                    <textarea disabled type="text" class="form-control" name="description" id="description"
                                        @if (isset($inventory->description)) value="{{ $inventory->description }}"
                                        @else
                                        placeholder="No description available" @endif>{{ $inventory->description }}</textarea>
                                </div>
                            </div>

                            <hr>

                            <a href="{{ route('updateLog', [$inventory->id, $inventory->inventory_number_to_itams]) }}" type="button" class="btn btn-block btn-outline-secondary col-sm-4">Update
                                Log</a>
                            <hr>
                            <a href="{{ route('inventories.edit', $inventory->id) }}" type="button"
                                class="btn btn-block btn-outline-primary col-sm-4">Edit</a>
                            <hr>

                            <div class="card">
                                <div class="card-header">
                                  <ul class="nav nav-pills ml-auto p-2">
                                    <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Тразакции</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Перемещения</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Получения</a></li>
                                  </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                  <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        {{-- заглушка --}}
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_2">
                                      @foreach ($inventory->inventoryRelocateTransactions as $transaction)
                                          @include('/layouts/includes/transactions/trasaction-sender')
                                      @endforeach
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_3">
                                      @foreach ($inventory->inventoryReceiveTransactions as $transaction)
                                        @include('/layouts/includes/transactions/trasaction-recipient')
                                      @endforeach
                                    </div>
                                    <!-- /.tab-pane -->
                                  </div>
                                  <!-- /.tab-content -->
                                </div><!-- /.card-body -->
                              </div>        
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
