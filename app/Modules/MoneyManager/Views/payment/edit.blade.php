@extends('layouts.app')

@section('title', trans('MoneyManager::category.edit.title'))
@section('page_header', trans('MoneyManager::category.edit.page_header'))
@section('page_header_description', trans('MoneyManager::category.edit.page_header_description'))

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{ trans('MoneyManager::category.edit.title') }}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ route('categories.update', ['id' => $category->id ]) }}" method="POST" enctype="multipart/form-data">
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
                {{ method_field('PUT') }}

                <div class="form-group">
                  <label for="name">{{ trans('MoneyManager::category.edit.labels.name') }}</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="{{ trans('MoneyManager::category.edit.placeholders.name') }}" value="{{ $category->name }}">
                </div>
                <div class="form-group">
                  <label for="avatar">{{ trans('MoneyManager::category.edit.labels.avatar') }}</label>
                  <input type="file" id="avatar" name="avatar">

                  <p class="help-block">{{ trans('MoneyManager::category.edit.descriptions.avatar') }}</p>
                  @if ($category->avatar)
                    <img src="{{ asset('storage/'.$category->avatar) }}" style="width:20px;height:20px" />
                  @endif
                </div>
                <div class="form-group">
                  <label for="name">{{ trans('MoneyManager::category.edit.labels.parent') }}</label>
                  <select class="form-control select2" style="width: 100%" name="parent_id">
                    <option value="">{{ trans('MoneyManager::category.edit.labels.select_parent') }}</option>
                    @foreach ($categories as $item)
                      <option value="{{ $item->id }}" {{ $item->id == $category->parent_id ? 'selected' : '' }} >{!! str_repeat('&nbsp;', $item->level * 10) !!} -- {{ $item->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">{{ trans('MoneyManager::category.edit.buttons.submit') }}</button>
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
