@extends('master-templates::admin.layout.back')

@section('content')
    <div class="content__header">
        @component('master-templates::components.pageTitle')
            @slot('title', __('authentication::rights.overview.title'))
            @slot('subTitle', __('authentication::rights.overview.subtitle', ['count' => count($rights)]))
        @endcomponent
        @if (Auth::user()->canEdit())
            <div class="action-bar action-bar--right">
                <div class="action-bar__item">
                    <a class="button button--primary" href="{{ action('\Dexperts\Authentication\Controllers\RightsController@create') }}" title="{{ __('authentication::rights.add') }}">{{ __('authentication::rights.add') }}</a>
                </div>
            </div>
        @endif
    </div>
    <div class="block">
        <table width="100%" class="table" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th class="table__header">{{__('authentication::rights.group_name')}}</th>
                    <th class="table__header">{{__('master-templates::lists.last_change')}}</th>
                    <th class="table__header">{{__('master-templates::lists.edit')}}</th>
                    <th class="table__header">{{__('master-templates::lists.delete')}}</th>
                </tr>
            </thead>
            <tbody>
            @forelse($rights as $right)
                <tr class="table__row table__row--columns">
                    <td class="table__column">
                        {{ $right->group_name }}
                    </td>
                    <td class="table__column">
                        {{ $right->getLatestChange() }}
                    </td>
                    <td class="table__column">
                        @component('master-templates::components.action-link', [
                                'module' => null,
                                'action' => '',
                                'url' => '/admin/rights/' . $right->id . '/edit',
                                'label' => __('master-templates::lists.edit')
                            ])
                        @endcomponent
                    </td>
                    <td class="table__column">
                        @component('master-templates::components.action-link', [
                                'module' => null,
                                'action' => '',
                                'url' => '/admin/rights/' . $right->id . '/delete',
                                'label' => __('master-templates::lists.delete')
                            ])
                        @endcomponent
                    </td>
                </tr>
            @empty
                <tr class="list__row  list__row">
                    <td colspan="4" class="table__column">
                        {{__('authentication::rights.no_rights')}}
                        <a class="table__link" href="{{ action('\Dexperts\Authentication\Controllers\RightsController@create') }}" title="{{ __('authentication::rights.add') }}">{{ __('authentication::rights.add') }}</a>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
