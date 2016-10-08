@extends('layouts.app')

@section('title', trans('MoneyManager::payment.index.title'))
@section('page_header', trans('MoneyManager::payment.index.page_header'))
@section('page_header_description', trans('MoneyManager::payment.index.page_header_description'))

@section('content')
  <!-- will be used to show any messages -->
  @if (Session::has('message'))
      <div class="alert alert-info">{{ Session::get('message') }}</div>
  @endif

  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">{{ trans('MoneyManager::payment.index.title') }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-striped table-hover">
            <thead>
            <tr>
              <th>#</th>
              <th>{{ trans('MoneyManager::payment.index.table.head.amount') }}</th>
              <th>{{ trans('MoneyManager::payment.index.table.head.paid_at') }}</th>
              <th>{{ trans('MoneyManager::payment.index.table.head.note') }}</th>
              <th>{{ trans('MoneyManager::payment.index.table.head.category') }}</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
              @foreach ($payments as $payment)
                <tr>
                  <td style="width:10px">{{ $loop->index + 1 }}.</td>
                  <!-- <td>{{ number_format($payment->amount, 0, '.', ',') }}</td> -->
                  <td>{{ money_format('%n', $payment->amount) }}</td>
                  <td>{{ $payment->paid_at->format(config('datetime.carbon.format')) }}</td>
                  <td>{{ $payment->note }}</td>
                  <td>{{ $payment->category->name }}</td>
                  <td>
                      <a href="{{ route('payments.edit', ['id' => $payment->id ]) }}"><span class="glyphicon glyphicon-edit"  aria-hidden="true"></span></a>&nbsp;&nbsp;<a href="javascript:submitDeleteForm('delete-form-{{ $payment->id }}')"><span class="glyphicon glyphicon-remove"  aria-hidden="true"></span></a>
                      <form id="delete-form-{{ $payment->id }}" role="form" action="{{ route('payments.destroy', ['id' => $payment->id ]) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                      </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
@endsection

@section('page_script')
<script type="text/javascript">
    function submitDeleteForm(formId) {
        if (confirm("{{ trans('MoneyManager::payment.index.confirm_message') }}")) {
            $('#' + formId).submit();
        }
    }
</script>
@endsection
