<div class="box-body box-body-search">
    <form action="/admin/setting/invoice" method="GET">
        <div class="row">
            {{--<div class="col-sm-1">--}}
                {{--<span class="label label-warning">--}}
                    {{--{!! trans('admin/base.search_by') !!}--}}
                {{--</span>--}}
            {{--</div>--}}
            <div class="col-sm-2">
                <div class="col-sm-4">
                    <span class="label label-info">
                    {!! trans('admin/invoice.status') !!}
                    </span>
                </div>
                <div class="col-sm-8">
                    <select class="form-control" name="status">
                        @foreach (["all","cancel","finish","sending","return"] as $field)
                            <option value="{!! $field !!}" {!! app('request')->input('status') == $field ? 'selected="selected"' : '' !!}>{!! $field !!}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="col-sm-2">
                <div class="col-sm-3"><span class="label label-info">{!! trans('admin/invoice.range') !!} </span></div>
                <div class="col-sm-8">
                    <?php $date=now();$yesterday=now()->subDays(10);?>
                <input type="text" name="daterange" value="{!! app('request')->input('daterange',$yesterday.'-'. $date) !!}" />
                </div>
            </div>
            <div class="col-sm-2">
                <div class="col-sm-4">
                   <span class="label label-info">
                    {!! trans('admin/invoice.username') !!}
                    </span>
                </div>
                <div class="col-sm-8">
                    <input type="text" name="username">
                </div>

            </div>

            <div class="col-sm-2">
                <div class="col-sm-4">
                   <span class="label label-info">
                    {!! trans('admin/invoice.userid') !!}
                    </span>
                </div>
                <div class="col-sm-8">
                    <input type="text" name="userid">
                </div>

            </div>


            <div class="col-sm-3 pull-right">
            <button class="btn pull-right">{!! trans('admin/base.filter') !!}</button>
        </div>
        </div>
        <div class="row pad">


        </div>
        {{--<button class="btn">{!! trans('admin/base.filter') !!}</button>--}}
    </form>
</div>
