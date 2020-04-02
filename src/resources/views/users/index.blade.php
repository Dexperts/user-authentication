@extends('admin.layout.back')

@section('content')
    <div class="container__inner">
        <div class="list">
            <table width="100%" class="table" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th>{{ __('admin/user.name') }}</th>
                        <th>{{ __('admin/user.email') }}</th>
                        <th>{{ __('admin/user.type') }}</th>
                        <th>{{ __('admin/lists.last_change') }}</th>
                        @if (Auth::user()->canEdit())
                            <th>
                                {{ __('admin/lists.edit') }}
                            </th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->type }}</td>
                            <td>{{ $user->getLatestChange() }}</td>
                            @if (Auth::user()->canEdit())
                                <td class="list__row__column"><a href="{{url('admin/users/' . $user->id . '/edit')}}" title="{{ __('admin/lists.edit') }}">{{ __('admin/lists.edit') }}</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if (Auth::user()->canEdit())
            <div class="action-bar action-bar--right">
                <div class="action-bar__item">
                    <a class="button button__primary" href="/admin/users/create" title="{{ __('admin/user.add') }}">{{ __('admin/user.add') }}</a>
                </div>
            </div>
        @endif
    </div>
@endsection
