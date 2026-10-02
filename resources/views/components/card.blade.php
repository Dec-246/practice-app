
<!-- merging a class whilts setting a default class name -->
<div {{ $attributes->merge(['class' => 'card']) }}>
    {{ $slot }}
</div>
