@php
    $options = [];
    foreach($products as $product) {
        $texts[] = $product->pivot->value_text;
    }
    $texts = array_unique($texts);

    if('city' === $code) {
        $name = $code . '_value_text[]';
        $multiple = 'multiple="multiple"';
    } else {
        $name = $code . '_value_text';
    }
@endphp

<div class="card">
    <div class="card-body">
        <label>{{ $label }}</label>

        <select name="{{ $name }}" class="form-control" {{ $multiple ?? '' }}style="width: 100%;">
            <option value="0"></option>
            @foreach($texts as $text)
                <option value="{{ $text }}">{{ $text }}</option>
            @endforeach
        </select>
    </div>
</div>

