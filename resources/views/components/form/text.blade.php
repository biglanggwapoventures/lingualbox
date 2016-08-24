<div class="form-group">
    {{ Form::label($name, $label) }}
    {{ Form::text($name, $value, array_merge(['class' => 'form-control'], $attributes)) }}
</div>