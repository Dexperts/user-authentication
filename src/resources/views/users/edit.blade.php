@extends('admin.layout.back')

@section('content')
    <div class="container__inner">
        <div class="card background__solid--white">
            <div class="card__header">
                Gebruiker wijzigen.
            </div>
            <div class="card__body">
                <form method="post" action="{{$actionPath}}">
                        @csrf
                        @if ($user->id)
                            @method('PATCH')
                        @endif
                        @include('admin.layout.errors')
                    <div class="form__group">
                        <label class="form__label">{{ __('admin/user.name') }}</label>
                        <input type="text" class="form__input" name="name" value="{{old('name', $user->name)}}" />
                    </div>
                    <div class="form__group">
                        <label class="form__label">{{ __('admin/user.email') }}</label>
                        <input type="text" class="form__input" name="email" value="{{old('email', $user->email)}}" />
                    </div>
                    @if (!$user->id)
                    <div class="form__group">
                        <label class="form__label">{{ __('admin/user.password') }}</label>
                        <input type="password" class="form__input" name="password" />
                    </div>
                    @endif
                    <div class="form__group">
                        <label class="form__label">{{ __('admin/user.rights') }}</label>
                        <select name="rights" class="form__select">
                            @foreach($rights as $right)
                                <option value="{{$right->id}}" {{($user->rights_id == $right->id ? ' selected' : '')}}>{{$right->group_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form__group">
                        <input type="submit" value="Opslaan" class="form__submit" />
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
