@extends('/layouts/main')

@section('title-page')
    {{ $user->name }}
@endsection

@section('head-section-main')
@endsection

@section('heder-content-main')
    {{ $user->name }}
@endsection

@section('content-main')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
              <div class="col-md-3">
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
    
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                  <div class="card-body box-profile">
                    <div class="text-center">
                      <img class="profile-user-img img-fluid img-circle" src="/dist/img/avatar4.png" alt="User profile picture">
                    </div>
    
                    <h3 class="profile-username text-center">{{ $user->name }}</h3>
    
                    <p class="text-muted text-center">
                        @foreach($user->roles as $role)
                        {{$role->name}} <br>
                        @endforeach
                      
                        {{$user->email}}
                    </p>
    
                    {{-- <ul class="list-group list-group-unbordered mb-3">
                      <li class="list-group-item">
                        <b>Followers</b> <a class="float-right">1,322</a>
                      </li>
                      <li class="list-group-item">
                        <b>Following</b> <a class="float-right">543</a>
                      </li>
                      <li class="list-group-item">
                        <b>Friends</b> <a class="float-right">13,287</a>
                      </li>
                    </ul>
    
                    <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
    
                <!-- About Me Box -->
                {{-- <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">About Me</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <strong><i class="fas fa-book mr-1"></i> Education</strong>
    
                    <p class="text-muted">
                      B.S. in Computer Science from the University of Tennessee at Knoxville
                    </p>
    
                    <hr>
    
                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
    
                    <p class="text-muted">Malibu, California</p>
    
                    <hr>
    
                    <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
    
                    <p class="text-muted">
                      <span class="tag tag-danger">UI Design</span>
                      <span class="tag tag-success">Coding</span>
                      <span class="tag tag-info">Javascript</span>
                      <span class="tag tag-warning">PHP</span>
                      <span class="tag tag-primary">Node.js</span>
                    </p>
    
                    <hr>
    
                    <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
    
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                  </div>
                  <!-- /.card-body -->
                </div> --}}
                <!-- /.card -->
              </div>
              <!-- /.col -->
              <div class="col-md-9">
                <div class="card">
                  <div class="card-header p-2">
                    <ul class="nav nav-pills">
                      <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Активность</a></li>
                      <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Тразакции перемещения</a></li>
                      <li class="nav-item"><a class="nav-link" href="#recive" data-toggle="tab">Транзакции получения</a></li>
                      <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Настройки</a></li>
                    </ul>
                  </div><!-- /.card-header -->

                  <div class="card-body">
                    <div class="tab-content">
                      <div class="tab-pane active" id="activity">
                          
                      </div>
                      <!-- /.tab-pane -->

                      <div class="tab-pane" id="recive">
                        <div class="timeline timeline-inverse">
                        {{-- Транзакции Получения! --}}
                        @foreach ($inventoryReceiveTransactions as $transaction)

                        @include('/layouts/includes/transactions/trasaction-recipient')
                         
                        @endforeach
                        </div>
                      </div>
                      
                      <div class="tab-pane" id="timeline">
                        <!-- The timeline -->
                        <div class="timeline timeline-inverse">
                            
                         {{--  Тразакции Перемещения!!! --}}
                         @foreach ($inventoryRelocateTransactions as $transaction)

                         @include('/layouts/includes/transactions/trasaction-sender')
                         
                         @endforeach
                        </div>
                      </div>
                      <!-- /.tab-pane -->
    
                      <div class="tab-pane" id="settings">
                        <form class="form-horizontal">
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                              <input type="email" class="form-control" id="inputName" placeholder="Name">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                              <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputName2" placeholder="Name">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                            <div class="col-sm-10">
                              <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                </label>
                              </div>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                              <button type="submit" class="btn btn-danger">Submit</button>
                            </div>
                          </div>
                        </form>
                      </div>
                      <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                  </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
    </section>

@endsection
