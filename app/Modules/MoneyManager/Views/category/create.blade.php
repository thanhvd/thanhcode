@extends('layouts.app')

@section('title', trans('MoneyManager::category.create.title'))
@section('page_header', 'Category')
@section('page_header_description', 'Create')

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
                  <input type="text" class="form-control" name="name" id="name" placeholder="{{ trans('MoneyManager::category.create.placeholders.name') }}">
                </div>
                <div class="form-group">
                  <label for="avatar">{{ trans('MoneyManager::category.create.labels.avatar') }}</label>
                  <input type="file" id="avatar" name="avatar">

                  <p class="help-block">{{ trans('MoneyManager::category.create.descriptions.avatar') }}</p>
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
