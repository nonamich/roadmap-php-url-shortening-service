@php
    $nextDirection = request('direction') === 'asc' ? 'desc' : 'asc';
@endphp

<table class="min-w-full table-fixed divide-y divide-gray-200 dark:divide-neutral-700">
    <thead>
        <tr>
            <th scope="col"
                class="text-wrap px-3 py-3 text-start text-xs font-medium uppercase text-blue-500 dark:text-blue-500">
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'created_at', 'direction' => $nextDirection]) }}">
                    @if ($nextDirection === 'desc')
                        ⮭
                    @else
                        ⮯
                    @endif
                    Created At
                </a>
            </th>
            <th scope="col"
                class="text-wrap px-3 py-3 text-start text-xs font-medium uppercase text-blue-500 dark:text-blue-500">
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'access_count', 'direction' => $nextDirection]) }}">
                    <span>
                        @if ($nextDirection === 'desc')
                            ⮭
                        @else
                            ⮯
                        @endif
                    </span>
                    Count
                </a>
            </th>
            <th scope="col"
                class="text-wrap px-3 py-3 text-start text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">
                From</th>
            <th scope="col"
                class="text-wrap px-3 py-3 text-start text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">
                To</th>
            <th scope="col"
                class="text-wrap px-3 py-3 text-end text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">
            </th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
        @foreach ($links as $link)
            <tr>
                <td class="text-wrap px-3 py-4 text-sm text-gray-800 dark:text-neutral-200">
                    {{ $link->created_at }}
                </td>
                </td>
                <td class="text-wrap px-3 py-4 text-sm text-gray-800 dark:text-neutral-200">
                    {{ $link->access_count }}
                </td>
                </td>
                <td class="text-wrap px-3 py-4 text-sm font-medium text-gray-800 dark:text-neutral-200">
                    <a target="_blank" class="text-blue-600"
                        href="{{ $link->redirect_from }}">{{ $link->redirect_from }}</a>
                </td>
                <td class="text-wrap px-3 py-4 text-sm text-gray-800 dark:text-neutral-200">
                    <a target="_blank" class="text-blue-600" href="{{ $link->url }}">{{ $link->url }}</a>
                </td>
                <td class="text-wrap px-3 py-4 text-end text-sm font-medium">
                    <a href="/{{ $link->code }}/edit"
                        class="inline-flex items-center gap-x-2 rounded-lg border border-transparent text-sm font-semibold text-blue-600 hover:text-blue-800 focus:text-blue-800 focus:outline-none disabled:pointer-events-none disabled:opacity-50 dark:text-blue-500 dark:hover:text-blue-400 dark:focus:text-blue-400">Edit</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $links->links() }}
