@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      @if (Auth::user()->admin)
        @include('layouts.admins.edit-delete-buttons', [
          'resource' => 'users',
          'id' => $user->id
        ])
      @endif

      {{-- user info --}}
      <h1>
        {{$user->name}}

        <small>
          {{ $user->admin ? 'Administrador' : 'Usuario' }}
          {!! Html::mailto($user->email) !!}
        </small>
      </h1>

      @if ($user->personalDetails)
        <hr>

        <h2>
          Fecha de nacimiento:
          {{ Date::parse($user->personalDetails->birthday)->format('l j F \d\e Y') }}
        </h2>

        <h1>C.I. {{ $user->personalDetails->ci }}</h1>

        <h2>
          @if ($user->personalDetails && $user->personalDetails->professor)
            {{ $user->personalDetails->professor->title->desc }}
          @endif
          {{$user->personalDetails->formattedNames(true)}}
        </h2>

        <h3>
          Teléfonos: <br/>

          {{$phoneParser->parseNumber($user->personalDetails->phone)}}

          <br/>

          {{$phoneParser->parseNumber($user->personalDetails->cellphone)}}
        </h3>

        @can('update', $user)
        <a
          href="{{ route("personalDetails.edit", $user->personalDetails->id) }}"
          class="btn btn-default">
          <i class="fa fa-btn fa-edit"></i>Editar Información Personal
        </a>
        @endcan
      @endif

      @if (!$user->personalDetails)
        <a href="{{ route("personalDetails.create", $user->id) }}"
           class="btn btn-default">
          <i class="fa fa-btn fa-plus"></i>Añadir Información Personal
        </a>
      @endif

      <hr>

      @if(Auth::user()->admin && $user->personalDetails && !$user->personalDetails->professor)
        <a href="{{ route('professors.create', $user->personalDetails->id) }}"
           class="btn btn-default"
        >
          <i class="fa fa-btn fa-plus"></i>Crear información Profesoral
        </a>
      @endif

      @if ($user->personalDetails && $user->personalDetails->professor)
        <h2>Posición: {{ $user->personalDetails->professor->position }}</h2>

        <a
          href="{{ route("professors.edit", $user->personalDetails->professor->id) }}"
          class="btn btn-default">
          <i class="fa fa-btn fa-edit"></i>Editar información Profesoral
        </a>
      @endif

      @include('layouts.admins.basic-audit', ['model' => $user])
    </div>
  </div>
@stop