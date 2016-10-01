@extends('layouts.app')

@section('title', trans('MoneyManager::category.index.title'))
@section('page_header', 'Category')
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
          <h3 class="box-title">{{ trans('MoneyManager::category.index.title') }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-striped table-hover">
            <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>{{ trans('MoneyManager::category.index.table.head.name') }}</th>
              <th>{{ trans('MoneyManager::category.index.table.head.avatar') }}</th>
              <th>{{ trans('MoneyManager::category.index.table.head.parent') }}</th>
              <th style="width: 40px">Label</th>
            </tr>
            </thead>
            <tbody>
              @foreach ($categories as $category)
                <tr>
                  <td>{{ $loop->index + 1 }}.</td>
                  <td>{{ $category->name }}</td>
                  <td>
                    @if ($category->avatar)
                      <img src="{{ asset('storage/'.$category->avatar) }}" />
                    @else
                      <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>
                    @endif
                  </td>
                  <td>{{ $category->category_id }}</td>
                  <td></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          {{ $categories->links() }}
        </div>
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
@endsection
