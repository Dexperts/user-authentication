@extends('admin.layout.back')

@section('content')
    <div class="list">
        <table width="100%" class="table" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th>{{__('admin/rights.group_name')}}</th>
                    <th>{{__('admin/lists.last_change')}}</th>
                    <th>{{__('admin/lists.edit')}}</th>
                    <th>{{__('admin/lists.delete')}}</th>
                </tr>
            </thead>
            <tbody>
            @forelse($rights as $right)
                <tr>
                    <td>
                        {{ $right->group_name }}
                    </td>
                    <td>
                        {{ $right->getLatestChange() }}
                    </td>
                    <td>
                        @component('components.action-link', [
                                'module' => null,
                                'action' => '',
                                'url' => '/admin/rights/' . $right->id . '/edit',
                                'label' => __('admin/lists.edit')
                            ])
                        @endcomponent
                    </td>
                    <td>
                        @component('components.action-link', [
                                'module' => null,
                                'action' => '',
                                'url' => '/admin/rights/' . $right->id . '/delete',
                                'label' => __('admin/lists.delete')
                            ])
                        @endcomponent
                    </td>
                </tr>
            @empty
                <tr class="list__row  list__row">
                    <td colspan="4">
                        {{__('admin/rights.no_rights')}}
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
        @if (Auth::user()->canEdit())
            <div class="action-bar action-bar--right">
                <div class="action-bar__item">
                    <a class="button button__primary" href="/admin/rights/create" title="{{ __('admin/rights.add') }}">{{ __('admin/rights.add') }}</a>
                </div>
            </div>
        @endif
    </div>
@endsection
