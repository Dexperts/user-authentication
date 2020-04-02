@extends('admin.layout.back')

@section('content')
    <div class="container__inner">
        <div class="card background__solid--white">
            <div class="card__header">
                Rechtengroep toevoegen.
            </div>
            <div class="card__body">
                <form method="post" action="{{$rightsAction}}">
                    @csrf
                    @if ($rights->id)
                        @method('PATCH')
                    @endif
                    @include('admin.layout.errors')
                    @component('components.input')
                        @slot('fieldname', 'group_name')
                        @slot('module', 'rights')
                        @slot('value', old('group_name', $rights->group_name))
                    @endcomponent
                    <div class="form__switch__wrapper">
                        <label>
                            <label class="form__switch">
                                <input type="checkbox" name="rights[]"
                                   value="admin" {{ (\App\Rights::hasAdmin($rights->allowed)) ? 'checked' : '' }}
                                   onclick="toggleOthers(this)"
                                />
                                <span class="form__switch__slider form__switch__slider--round"></span>
                            </label>
                            Admin <small>Deze groep krijgt alle onderstaande rechten.</small>
                        </label>
                    </div>
                    @foreach($modules as $module => $moduleLabel)
                        <fieldset class="fieldset fieldset-m-third fieldset-s-whole">
                            <legend class="legend">{{$moduleLabel}}</legend>
                            <ul class="list__simple">
                            @foreach($availableRights as $right => $rightLabel)
                                <li class="form__switch__wrapper">
                                    <label>
                                        <label class="form__switch">
                                            <input type="checkbox" name="rights[]" onclick="disabledAdminOption()"
                                               {{ (strstr($rights->allowed, strtolower($module) . '-' . strtolower($right)) != false)
                                                ? 'checked' : '' }}
                                               value="{{strtolower($module)}}-{{strtolower($right)}}" />
                                            <span class="form__switch__slider form__switch__slider--round"></span>
                                        </label>
                                        {{$rightLabel}}
                                    </label>
                                </li>
                            @endforeach
                            </ul>
                        </fieldset>
                    @endforeach
                    <div class="form__group">
                        <input type="submit" value="Opslaan" class="form__button" />
                        <a href="/admin/rights" title="Annuleren">Annuleren</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
