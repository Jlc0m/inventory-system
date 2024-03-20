    <div class="invoice p-3 mb-3">
        <!-- title row -->
        <div class="row">
            <div class="col-12">
                <h4>
                    <small class="float-right">Date: {{$transaction->created_at}}</small>
                </h4>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                Отправитель
                <address>
                    <strong>ТОВ {{$transaction->company->name}}</strong><br>
                    Город: {{$transaction->city->name}}<br>
                    Офис: {{-- {{$transaction->office->name}} --}}<br>
                    Отправитель: {{$transaction->user->name}}<br>
                    Phone: (804) 123-5432<br>
                    Email: {{$transaction->user->email}}
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                Получатель
                <address>
                    <strong>ТОВ {{$transaction->inventoryReceiveTransaction->company->name}}</strong><br>
                    Город: {{$transaction->inventoryReceiveTransaction->city->name}}<br>
                    Офис: {{-- {{$transaction->inventoryReceiveTransaction->office->name}} --}}<br>
                    Получатель: {{$transaction->inventoryReceiveTransaction->user->name}}<br>
                    Phone: (555) 539-1037<br>
                    Email: {{$transaction->inventoryReceiveTransaction->user->email}}
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col mt-3">
                <b>Статус отправки: @if($transaction->status == false) <b>Еще не отправлено</b>
                @can('Supply')
                @if($transaction->approved === true)
                <form action="{{route('approved-transaction', [$transaction->id])}}" method="POST">
                    @method('POST')
                    @csrf
                    <input name="status" value="1" hidden>
                    <button type="submit">Отправлено!</button>
                </form>
                @endif
                @endcan
                @else <b class="bg-green">Отправлено</b> @endif </b><br>
                <b>Статус одобрения: @if($transaction->approved == false) <b class="bg-red">Не одобрено!</b>

                    @can('SuperAdmin')
                <form action="{{route('approved-transaction', [$transaction->id])}}" method="POST">
                    @method('POST')
                    @csrf
                    <input name="approved" value="1" hidden>
                    <button type="submit">Одобрить</button>
                </form>
                @endcan

                @else <b class="bg-green">Одобрено! Отправляйте.</b> @endif </b><br>
                <b>ID Тразакции: </b> {{$transaction->id}} <br>
                <b>Payment Due:</b> 2/22/2014<br>
                <b>Account:</b> 968-34567
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Инвентарный номер</th>
                            <th>Наименование</th>
                            <th>Внутренний инв.</th>
                            <th>Описание</th>
                            <th>Количество</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaction->inventories as $item)
                        <tr>
                            <td><a href="{{ route('inventories.show', $item->id) }}">{{ $item->inventory_number_to_itams }}</a></td>
                            <td>{{$item->category->name}}</td>
                            <td>Нет</td>
                            <td>Нет</td>
                            <td>1 шт.</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-6">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Общее количество: {{count($transaction->inventories)}}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-12">
                <a href="#" rel="noopener" target="_blank" class="btn btn-default"><i
                        class="fas fa-print"></i> Print</a>
                <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                </button>
            </div>
        </div>
    </div>

