@extends('layouts.app')

@section('title', trans('MoneyManager::payment.index.title'))
@section('page_header', 'Payment')
@section('page_header_description', 'Index')

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
              <th>{{ trans('MoneyManager::payment.index.table.head.name') }}</th>
              <th>{{ trans('MoneyManager::payment.index.table.head.avatar') }}</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
              @foreach ($payments as $payment)
                <tr>
                  <td style="width:10px">{{ $loop->index + 1 }}.</td>
                  <td>{!! str_repeat('&nbsp;', $payment->level * 10) !!} <span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span> {{ $payment->name }}</td>
                  <td>
                    @if ($payment->avatar)
                      <a><img src="{{ asset('storage/'.$payment->avatar) }}" style="width:20px;height:20px" /></a>
                    @else
                      <a><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></a>
                    @endif
                  </td>
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
