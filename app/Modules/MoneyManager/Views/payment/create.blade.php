@extends('layouts.app')

@section('title', trans('MoneyManager::payment.create.title'))
@section('page_header', trans('MoneyManager::payment.create.page_header'))
@section('page_header_description', trans('MoneyManager::payment.create.page_header_description'))

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{ trans('MoneyManager::payment.create.title') }}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ route('payments.store') }}" method="post" enctype="multipart/form-data">
              <div class="box-body">
                @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{ csrf_field() }}
                <div class="form-group">
                  <label for="amount">{{ trans('MoneyManager::payment.create.labels.amount') }}</label>
                  <input type="text" class="form-control" id="amount" value="{{ old('amount') }}">
                  <input type="hidden" name="amount" value="{{ old('amount') }}">
                </div>
                <div class="form-group">
                  <label for="paid_at">{{ trans('MoneyManager::payment.create.labels.paid_at') }}</label>
                  <input type="text" class="form-control" name="paid_at" id="paid_at" placeholder="{{ trans('MoneyManager::payment.create.placeholders.paid_at') }}" value="{{ old('paid_at') }}">
                </div>
                <div class="form-group">
                  <label for="note">{{ trans('MoneyManager::payment.create.labels.note') }}</label>
                  <textarea class="form-control" name="note" id="note" placeholder="{{ trans('MoneyManager::payment.create.placeholders.note') }}">{{ old('note') }}</textarea>
                </div>
                <div class="form-group">
                  <label for="category_id">{{ trans('MoneyManager::payment.create.labels.category') }}</label>
                  <select class="form-control select2" style="width: 100%" name="category_id">
                    <option value="">{{ trans('MoneyManager::payment.create.labels.select_category') }}</option>
                    @foreach ($categories as $item)
                      <option value="{{ $item->id }}" {{ $item->id == old('category_id') ? 'selected' : '' }}>{!! str_repeat('&nbsp;', $item->level * 10) !!} -- {{ $item->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">{{ trans('MoneyManager::payment.create.buttons.submit') }}</button>
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
    //Initialize Select2 Elements
    $(".select2").select2({
        templateSelection: function(data, container) {
            return $.trim(data.text.replace(/\-/g, ''));
        }
    });

    $('#paid_at').daterangepicker({
        timePicker: true,
        timePickerIncrement: 15,
        locale: {
            format: "{{ config('datetime.moment.format') }}"
        },
        singleDatePicker: true,
        startDate: moment()
    });

    $("#amount").inputmask('999.999.999.9999 VNĐ', {
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
</script>
@endsection
