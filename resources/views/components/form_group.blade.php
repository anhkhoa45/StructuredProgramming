<div class="form-group row {!! $hasError ? 'has-error' : '' !!}" >
    <label class="col-sm-3 control-label">
        {{ $label }}
    </label>
    <div class="col-sm-9">
        {{ $input }}
        @if($hasError)
        <span class="help-block">{{ $error }}</span>
        @endif
    </div>
</div>
