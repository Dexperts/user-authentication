<div class="card background__solid--white">
    <div class="card__header">{{ __('authentication::login.title') }}</div>

    <div class="card__body">
        <form method="POST" action="{{ route('login') }}" aria-label="{{ __('authentication::login.title') }}">
            @csrf

            <div class="form__group">
                <label for="email" class="form__label">{{ __('authentication::login.email') }}</label>
                <input data-qa="email" id="email" type="email"
                       class="form__input {{ isset($errors) && $errors->has('email') ? ' form__input--invalid' : '' }}"
                       name="email" value="{{ old('email') }}"
                       required {{ old('email') ? '' : 'autofocus' }}>
                @if (isset($errors) && $errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form__group">
                <label for="password" class="form__label">{{ __('authentication::login.password') }}</label>
                <input data-qa="password" id="password" type="password"
                       class="form__input{{ isset($errors) && $errors->has('password') ? ' form__input--invalid' : '' }}"
                       name="password" required {{ old('email') ? 'autofocus' : ''}}>

                @if (isset($errors) && $errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            @if (session("auth_message"))
                <div class="form__group">
                    <p class="form__group--error">{{session("auth_message")}}</p>
                </div>
            @endif

            <div class="form__group">
                <button data-qa="loginAction" type="submit" class="form__submit">
                    {{ __('authentication::login.action') }}
                </button>
            </div>
        </form>
    </div>
</div>
{{--<div class="action-bar">--}}
    {{--<div class="action-bar__left">--}}
        {{--<label class="form-check-label" for="remember">--}}
            {{--<input class="form-check-input" type="checkbox" name="remember"--}}
                   {{--id="remember" {{ old('remember') ? 'checked' : '' }}>--}}
            {{--{{ __('login.remember_me') }}--}}
        {{--</label>--}}
    {{--</div>--}}
    {{--<div class="action-bar__right">--}}
        {{--<a class="btn btn-link" href="{{ route('password.request') }}">{{ __('login.forgot_password') }}</a>--}}
    {{--</div>--}}
{{--</div>--}}
