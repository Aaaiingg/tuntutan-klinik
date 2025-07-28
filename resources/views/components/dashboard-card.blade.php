@props(['title', 'value' => null, 'color' => 'gray', 'prefix' => ''])

<div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
    <div class="flex justify-between items-center mb-2">
        <h4 class="text-gray-600 dark:text-gray-300 text-sm">{{ $title }}</h4>
        @isset($actions)
            <div>
                {{ $actions }}
            </div>
        @endisset
    </div>

    @isset($value)
        <div class="text-center">
            <h2 class="text-2xl font-bold text-{{ $color }}-600 dark:text-{{ $color }}-400 mt-2">
                @if ($prefix === 'RM')
                    {{ $prefix }}{{ number_format($value, 2) }}
                @else
                    {{ intval($value) }}
                @endif
            </h2>
        </div>
    @endisset
</div>
