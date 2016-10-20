@extends('layouts.app')

@section('title', trans('MoneyManager::category.index.title'))
@section('page_header', trans('MoneyManager::category.index.page_header'))
@section('page_header_description', trans('MoneyManager::category.index.page_header_description'))

@section('content')
  <!-- will be used to show any messages -->
  @if (Session::has('message'))
      <div class="alert alert-info">{{ Session::get('message') }}</div>
  @endif

  <div class="row">
    <!-- Create form -->
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
            @include('shared.errors')

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
              <input class="easyui-combotree" style="width:100%" name="parent_id" value="{{ old('parent_id') }}"
                data-options="
                    url: 'money-manager/combotree-categories',
                    method: 'get',
                    formatter: formatComboTree
              ">
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
    <!-- List category -->
    @include('MoneyManager::category._list')
    <!-- /.col -->
  </div>
  <!-- /.row -->
@endsection
