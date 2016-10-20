@extends('layouts.app')

@section('title', trans('MoneyManager::payment.edit.title'))
@section('page_header', trans('MoneyManager::payment.edit.page_header'))
@section('page_header_description', trans('MoneyManager::payment.edit.page_header_description'))

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{ trans('MoneyManager::payment.edit.title') }}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ route('payments.update', [ 'id' => $payment->id ]) }}" method="post">
              <div class="box-body">
                @include('shared.errors')

                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="form-group">
                  <label for="amount">{{ trans('MoneyManager::payment.edit.labels.amount') }}</label>
                  <input type="text" class="form-control" id="amount" value="{{ old('amount') ?: $payment->amount }}">
                  <input type="hidden" name="amount" value="{{ old('amount') ?: $payment->amount }}">
                </div>
                <div class="form-group">
                  <label for="paid_at">{{ trans('MoneyManager::payment.edit.labels.paid_at') }}</label>
                  <input type="text" class="form-control" name="paid_at" id="paid_at" placeholder="{{ trans('MoneyManager::payment.edit.placeholders.paid_at') }}" value="{{ old('paid_at') ?: $payment->paid_at }}">
                </div>
                <div class="form-group">
                  <label for="note">{{ trans('MoneyManager::payment.edit.labels.note') }}</label>
                  <textarea class="form-control" name="note" id="note" placeholder="{{ trans('MoneyManager::payment.edit.placeholders.note') }}">{{ old('note') ?: $payment->note }}</textarea>
                </div>
                <div class="form-group">
                  <label for="category_id">{{ trans('MoneyManager::payment.edit.labels.category') }}</label>
                  <input class="easyui-combotree" style="width:100%" name="category_id" value="{{ old('category_id') ?: $payment->category_id }}"
                    data-options="
                        url: 'money-manager/combotree-categories',
                        method: 'get',
                        formatter: formatComboTree
                  ">
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">{{ trans('MoneyManager::payment.edit.buttons.submit') }}</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
    </div>
@endsection

@section('page_script')
<script>
  $(function () {
    $.amount = {
        setValue: function() {
            $('input[name=amount]').val($("#amount").inputmask('unmaskedvalue'));
        }
    }

    $('#paid_at').daterangepicker({
        timePicker: true,
        timePickerIncrement: 15,
        locale: {
            format: "{{ config('datetime.moment.format') }}"
        },
        singleDatePicker: true,
        startDate: moment()
    });

    $("#amount").inputmask('999.999.999.999 VNĐ', {
        numericInput: true,
        rightAlign: false,
        oncomplete: function() {
            $.amount.setValue();
        },
        onincomplete: function() {
            $.amount.setValue();
        },
        onKeyDown: function() {
            $.amount.setValue();
        }
    });
  });

  // Format name column, add avatar prepend name
    function formatComboTree(node) {
        var avatar = '<a style="color:#f39c12; border:black"><span class="glyphicon glyphicon-folder-close" aria-hidden="true"></span></a>';

        if (node.avatar){
            avatar = '<a><img src=\"{{ asset("storage") }}/' + node.avatar + '\" style="width:16px;height:18px" /></a>';
        }
        return avatar + '&nbsp;&nbsp;' + node.text;
    }
</script>
@endsection
