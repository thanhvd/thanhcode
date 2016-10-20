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
            @include('shared.errors')

            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="form-group">
              <label for="name">{{ trans('MoneyManager::category.edit.labels.name') }}</label>
              <input type="text" class="form-control" name="name" id="name" placeholder="{{ trans('MoneyManager::category.edit.placeholders.name') }}" value="{{ old('name') ?: $category->name }}">
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
              <label for="parent_id">{{ trans('MoneyManager::category.edit.labels.parent') }}</label>
              <input class="easyui-combotree" style="width:100%" name="parent_id" value="{{ old('parent_id') ?: $category->parent_id }}"
                data-options="
                    url: 'money-manager/combotree-categories',
                    method: 'get',
                    formatter: formatComboTree
              ">
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
    <!-- List category -->
    @include('MoneyManager::category._list')
    <!-- /.col -->
</div>
@endsection
