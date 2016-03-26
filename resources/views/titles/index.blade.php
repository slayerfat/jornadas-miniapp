@extends('layouts.app')

@section('css')
  <link rel="stylesheet" type="text/css"
        href="{!! asset('css/bootstrap-table.css') !!}">
@stop

@section('content')
  <div class="container">
    <h1>Títulos Descriptivos en el sistema</h1>
    <a href="{{ route('titles.create') }}" class="btn btn-default">
      <i class="fa fa-btn fa-plus"></i>Crear Título
    </a>
    <hr/>
    <div class="row">
      <div class="col-sm-12">
        <table
          id="tabla"
          data-toggle="table"
          data-search="true"
          data-pagination="true"
          data-page-list="[10, 25, 50, 100]"
          data-show-toggle="true"
          data-show-columns="true"
          data-click-to-select="true"
          data-maintain-selected="true"
          data-sort-name="first_name"
        >
          <thead>
          <th data-field="operate" data-formatter="operateFormatter"
              data-events="operateEvents">Ver
          </th>
          <th data-field="resource" data-sortable="true" data-switchable="true">
            Id
          </th>
          <th data-field="email" data-sortable="true" data-switchable="true">
            Descripción
          </th>
          <th data-field="admin" data-sortable="true" data-switchable="true">
            Total Profesores
          </th>
          </thead>
          <tbody>
          @foreach ($titles as $title)
            <tr>
              <td></td>
              <td>
                {{ $title->id }}
              </td>
              <td>
                {{ $title->desc }}
              </td>
              <td>
                {{ $title->professors->count() }}
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@stop

@section('js')
  <script src="{!! asset('js/bootstrap-table.js') !!}"></script>
  <script src="{!! asset('js/bootstrap-table-es-CR.js') !!}"></script>
  <script src="{!! asset('js/initBootstrapTable.js') !!}"></script>
  <script type="text/javascript">
    initBootstrapTable("{!! route('titles.show', 'no-data') !!}")
  </script>
@stop
