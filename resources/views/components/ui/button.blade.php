@props([
    'size' => 'md',          
    'variant' => 'primary',
    'startIcon' => null,
    'endIcon' => null,
    'className' => '',
    'disabled' => false,
])

@php
    // Base classes
    $base = 'inline-flex items-center justify-center font-medium gap-2 rounded-lg transition';

    // Size map
    $sizeMap = [
        'sm' => 'px-4 py-3 text-sm',
        'md' => 'px-5 py-3.5 text-sm',
    ];
    $sizeClass = $sizeMap[$size] ?? $sizeMap['md'];

    // Variant map
    $variantMap = [
        'primary' => 'bg-brand-500 text-white shadow-theme-xs hover:bg-brand-600 disabled:bg-brand-300',
        'outline' => 'bg-white text-gray-700 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:ring-gray-700 dark:hover:bg-white/[0.03] dark:hover:text-gray-300',
    ];
    $variantClass = $variantMap[$variant] ?? $variantMap['primary'];

    // disabled classes
    $disabledClass = $disabled ? 'cursor-not-allowed opacity-50' : '';

    // final classes (merge user className too)
    $classes = trim("{$base} {$sizeClass} {$variantClass} {$className} {$disabledClass}");
@endphp

<button
    wire:loading.attr="disabled"
    {{ $attributes->class($classes)->merge([
        'type' => $attributes->get('type', 'button'),
    ]) }}
    @disabled($disabled)
>
    <span wire:loading.remove {{ $attributes->has('wire:target') ? 'wire:target='.$attributes->get('wire:target') : '' }}>
        @if($startIcon)
            <span class="flex items-center">{!! $startIcon !!}</span>
        @endif

        {{ $slot }}

        @if($endIcon)
            <span class="flex items-center">{!! $endIcon !!}</span>
        @endif
    </span>

    <span
        wire:loading
        {{ $attributes->has('wire:target') ? 'wire:target='.$attributes->get('wire:target') : '' }}
        class="inline-flex items-center gap-2"
    >
        <i class="fas fa-spinner fa-spin"></i>
        Loading...
    </span>
</button>
