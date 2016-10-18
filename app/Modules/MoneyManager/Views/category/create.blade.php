@extends('layouts.app')

@section('title', trans('MoneyManager::category.create.title'))
@section('page_header', trans('MoneyManager::category.create.page_header'))
@section('page_header_description', trans('MoneyManager::category.create.page_header_description'))

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{ trans('MoneyManager::category.create.title') }}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
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
                  <label for="name">{{ trans('MoneyManager::category.create.labels.name') }}</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="{{ trans('MoneyManager::category.create.placeholders.name') }}" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                  <label for="avatar">{{ trans('MoneyManager::category.create.labels.avatar') }}</label>
                  <input type="file" id="avatar" name="avatar">

                  <p class="help-block">{{ trans('MoneyManager::category.create.descriptions.avatar') }}</p>
                </div>
                <div class="form-group">
                  <label for="parent_id">{{ trans('MoneyManager::category.create.labels.parent') }}</label>
                  <select class="form-control select2" style="width: 100%" name="parent_id">
                    <option value="">{{ trans('MoneyManager::category.create.labels.select_parent') }}</option>
                    @foreach ($categories as $item)
                      <option value="{{ $item->id }}" {{ $item->id == old('category_id') ? 'selected' : '' }}>{!! str_repeat('&nbsp;', $item->level * 10) !!} -- {{ $item->name }}</option>
                    @endforeach
                  </select>
                  <input class="easyui-combotree" data-options="url:'money-manager/combotree-categories',method:'get',label:'Select Node:',labelPosition:'top'" style="width:100%">
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">{{ trans('MoneyManager::category.create.buttons.submit') }}</button>
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
    //Initialize Select2 Elements
    $(".select2").select2({
        templateSelection: function(data, container) {
            return $.trim(data.text.replace(/\-/g, ''));
        }
    });
  });
</script>
@endsection
