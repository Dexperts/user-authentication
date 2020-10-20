@extends('master-templates::admin.layout.back')

@section('content')
    <div class="content__header">
        @component('master-templates::components.pageTitle')
            @slot('title', __('authentication::user.overview.title'))
            @slot('subTitle', __('authentication::user.overview.subtitle', ['count' => count($users)]))
        @endcomponent
        @if (Auth::user()->canEdit())
            <div class="action-bar action-bar--right">
                <div class="action-bar__item">
                    <a class="button button--primary" href="{{ action('\Dexperts\Authentication\Controllers\UserController@create') }}" title="{{ __('authentication::user.add') }}">{{ __('authentication::user.add') }}</a>
                </div>
            </div>
        @endif
    </div>
    <div class="block">
        <table width="100%" class="table" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th class="table__header">{{ __('authentication::user.name') }}</th>
                    <th class="table__header">{{ __('authentication::user.email') }}</th>
                    <th class="table__header">{{ __('authentication::user.type') }}</th>
                    <th class="table__header">{{ __('master-templates::lists.last_change') }}</th>
                    @if (\Dexperts\Authentication\Rights::isAllowed('users', 'update'))
                        <th class="table__header">
                            {{ __('master-templates::lists.edit') }}
                        </th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="table__row table__row--columns">
                        <td class="table__column">{{ $user->name }}</td>
                        <td class="table__column">{{ $user->email }}</td>
                        <td class="table__column">{{ $user->type }}</td>
                        <td class="table__column">{{ $user->getLatestChange() }}</td>
                        @if (\Dexperts\Authentication\Rights::isAllowed('users', 'update'))
                            <td class="list__row__column table__column">
                                <a class="table__link" href="{{url('admin/users/' . $user->id . '/edit')}}" title="{{ __('master-templates::lists.edit') }}">{{ __('master-templates::lists.edit') }}</a>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
