@extends('/layouts/main')

@section('title-page')
    User settings
@endsection

@section('heder-content-main')
    User settings
@endsection

@section('content-main')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-end">
                            
                            <a type="button" class="btn btn-block btn-outline-success col-md-3" href="{{ route('users.create') }}">Add user</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">Id</th>
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th>Country</th>
                                        <th>Company</th>
                                        <th>City</th>
                                        <th>Department</th>
                                        <th>Condition</th>
                                        <th style="width: 40px">Edit/delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>
                                                <a href="{{ route('profile', [$user])}}">{{ $user->name }}</a>
                                            </td>
                                            <td>
                                                @foreach ($user->roles as $role)
                                                {{ $role->name }}
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($user->countries as $country)
                                                    {{ $country->name }},
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($user->companies as $company)
                                                {{ $company->name }},
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($user->cities as $city)
                                                {{ $city->name }},
                                                @endforeach
                                            </td>
                                            <td>
                                                @if (isset($user->department_id))
                                                    {{ $user->department->name }}
                                                @else
                                                    none department
                                                @endif
                                            </td>
                                            <td>
                                                @if (isset($user->condition_id))
                                                    {{ $user->condition->name }}
                                                @else
                                                    none condition
                                                @endif
                                            </td>
                                            <td style="width: 40px">
                                                <div class="btn-group">
                                                    <a href="{{ route('users.edit', $user->id) }}" type="button"
                                                        class="btn btn-success">edit</a>
                                                    <a type="button" class="btn btn-danger">delete</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                {{ $users->withQueryString()->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection
