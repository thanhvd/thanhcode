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
                      <a><img src="{{ asset('storage/'.$category->avatar) }}" style="width:20px;height:20px" /></a>
                    @else
                      <a><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></a>
                    @endif
                  </td>
                  <td>
                      <a href="{{ route('categories.edit', ['id' => $category->id ]) }}"><span class="glyphicon glyphicon-edit"  aria-hidden="true"></span></a>&nbsp;&nbsp;<a href="javascript:submitDeleteForm('delete-form-{{ $category->id }}')"><span class="glyphicon glyphicon-remove"  aria-hidden="true"></span></a>
                      <form id="delete-form-{{ $category->id }}" role="form" action="{{ route('categories.destroy', ['id' => $category->id ]) }}" method="POST">
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
        if (confirm("{{ trans('MoneyManager::category.index.confirm_message') }}")) {
            $('#' + formId).submit();
        }
    }
</script>
@endsection
