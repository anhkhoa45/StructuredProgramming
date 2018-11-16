<div class="box-body box-body-search">
    <form action="" method="GET">
        <div class="col-sm-1">
            <span class="label label-warning">
                {!! trans('backend/base.search_by') !!}
            </span>
        </div>
        <div class="col-sm-3">
            <select class="form-control" name="search_by">
                @foreach ($fields as $key => $field)
                <option value="{!! $key !!}" {!! app('request')->input('search_by') == $key ? 'selected="selected"' : '' !!}>{!! $field !!}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-3">
            <input class="form-control" name="search_text" placeholder="{!! trans('backend/base.search_term') !!}" value="{!! app('request')->input('search_text') !!}"/>
        </div>
        <button class="btn">{!! trans('backend/base.filter') !!}</button>
    </form>
</div>