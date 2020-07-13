@extends('master-templates::admin.layout.back')

@section('content')
    <form method="post" action="{{$actionPath}}">
        @csrf
        @if ($user->id)
            @method('PATCH')
        @endif
        <div class="content__header">
            <h1 class="title">{{__('authentication::user.edit.title')}}</h1>
            <div class="action-bar action-bar--right">
                <div class="action-bar__item">
                    <input type="submit" value="{{__('master-templates::lists.save')}}" class="button button--primary" />
                </div>
                <div class="action-bar__item">
                    <a class="button button--link" href="{{action('\Dexperts\Authentication\Controllers\UserController@index')}}" title="{{__('master-templates::lists.cancel')}}">{{__('master-templates::lists.cancel')}}</a>
                </div>
            </div>
        </div>
        <div class="block">
            @include('master-templates::admin.layout.errors')
            <div class="form__group">
                <label class="form__label">{{ __('authentication::user.name') }}</label>
                <input type="text" class="form__input" placeholder="{{ __('authentication::user.name') }}" name="name" value="{{old('name', $user->name)}}" />
            </div>
            <div class="form__group">
                <label class="form__label">{{ __('authentication::user.email') }}</label>
                <input type="text" class="form__input" name="email" placeholder="{{ __('authentication::user.email') }}" value="{{old('email', $user->email)}}" />
            </div>
            @if (!$user->id)
            <div class="form__group">
                <label class="form__label">{{ __('authentication::user.password') }}</label>
                <input type="password" class="form__input" name="password" />
            </div>
            @endif
            <div class="form__group">
                <label class="form__label">{{ __('authentication::user.rights') }}</label>
                <select name="rights" class="form__select">
                    @foreach($rights as $right)
                        <option value="{{$right->id}}" {{($user->rights_id == $right->id ? ' selected' : '')}}>{{$right->group_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form__group">

            </div>
        </div>
    </form>
@endsection
