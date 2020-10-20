@extends('master-templates::admin.layout.back')

@section('content')
    <form method="post" action="{{$rightsAction}}">
        @csrf
        @if ($rights->id)
            @method('PATCH')
        @endif
        <div class="content__header">
            <h1 class="title">{{__('authentication::rights.edit_title')}}</h1>
            <div class="action-bar action-bar--right">
                <div class="action-bar__item">
                    <input type="submit" value="{{__('master-templates::lists.save')}}" class="button button--primary" />
                </div>
                <div class="action-bar__item">
                    <a class="button button--link" href="{{action('\Dexperts\Authentication\Controllers\RightsController@index')}}" title="{{__('master-templates::lists.cancel')}}">{{__('master-templates::lists.cancel')}}</a>
                </div>
            </div>
        </div>
        <div class="block">
            @include('master-templates::admin.layout.errors')
            @component('master-templates::components.input')
                @slot('fieldname', 'group_name')
                @slot('module', 'rights')
                @slot('translation', __('authentication::rights.group_name'))
                @slot('value', old('group_name', $rights->group_name))
            @endcomponent
            <div class="form__group">
                <div class="form__switch__wrapper">
                    <label class="form__label form__label--light">
                        <label class="form__switch">
                            <input type="checkbox" name="rights[]"
                                   value="admin" {{ (\Dexperts\Authentication\Rights::hasAdmin($rights->allowed)) ? 'checked' : '' }}
                                   onclick="toggleOthers(this)"
                            />
                            <span class="form__switch__slider form__switch__slider--round"></span>
                        </label>
                        {{ __('authentication::rights.all_rights_title')}} <small>{{__('authentication::rights.all_rights_description')}}</small>
                    </label>
                </div>
            </div>
            @foreach($modules as $module => $moduleLabel)
                @if (($moduleLabel !== 'Products' && $moduleLabel !== 'Producten') || ($moduleLabel === 'Products' || $moduleLabel === 'Producten') && env('DEXPERTS_USE_MODULES_PRODUCTS'))
                <fieldset class="fieldset fieldset-m-third fieldset-s-whole">
                    <legend class="legend">{{$moduleLabel}}</legend>
                    <ul class="list__simple">
                    @foreach($availableRights as $right => $rightLabel)
                        <li class="form__switch__wrapper">
                            <label class="form__label form__label--light">
                                <label class="form__switch">
                                    <input type="checkbox" name="rights[]" onclick="disabledAdminOption()"
                                       {{ (strstr($rights->allowed, strtolower($moduleLabel) . '-' . strtolower($right)) != false)
                                        ? 'checked' : '' }}
                                       value="{{strtolower($moduleLabel)}}-{{strtolower($right)}}" />
                                    <span class="form__switch__slider form__switch__slider--round"></span>
                                </label>
                                {{$rightLabel}}
                            </label>
                        </li>
                    @endforeach
                    </ul>
                </fieldset>
                @endif
            @endforeach
        </div>
    </form>
    <script>
      (function(window) {

        window.toggleOthers = function(element) {
          var checkboxes = document.querySelectorAll('input[type="checkbox"]');
          for(var index in checkboxes) {
            if (checkboxes[index].value !== 'admin') {
              if (element.checked === true) {
                checkboxes[index].checked = false;
                checkboxes[index].disabled = true;
              } else {
                checkboxes[index].disabled = false;
              }
            }
          }
        };

        window.disabledAdminOption = function() {
          var adminCheckbox = document.querySelector('input[value="admin"]');
          if (!window.noneOptionsSelected()) {
            adminCheckbox.checked = false;
            adminCheckbox.disabled = true;
          } else {
            adminCheckbox.disabled = false;
          }
        };

        window.noneOptionsSelected = function() {
          var allCheckboxes = document.querySelectorAll('input[type="checkbox"]');
          var noneOptionsChecked = true;
          for(var index in allCheckboxes) {
            if (allCheckboxes[index].checked) {
              noneOptionsChecked = false;
              continue;
            }
          }
          return noneOptionsChecked;
        };

      })(window);
    </script>
@endsection
