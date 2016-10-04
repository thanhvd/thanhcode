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
              <th>#</th>
              <th>{{ trans('MoneyManager::category.index.table.head.name') }}</th>
              <th>{{ trans('MoneyManager::category.index.table.head.avatar') }}</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
              @foreach ($categories as $category)
                <tr>
                  <td style="width:10px">{{ $loop->index + 1 }}.</td>
                  <td>{!! str_repeat('&nbsp;', $category->level * 10) !!} <span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span> {{ $category->name }}</td>
                  <td>
                    @if ($category->avatar)
                      <img src="{{ asset('storage/'.$category->avatar) }}" style="width:20px;height:20px" />
                    @else
                      <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
                    @endif
                  </td>
                  <td>
                      <a href="money-manager/categories/{{ $category->id }}/edit">Edit</a>
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
