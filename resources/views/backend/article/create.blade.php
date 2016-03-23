@extends('app')

@section('css')
    <link href="{{ asset('/css/components/form-advanced.almost-flat.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/components/form-select.almost-flat.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="uk-grid uk-grid-collapse">
        <div class="uk-width-small-1-3 uk-container-center">
            <div class="uk-panel">
                <form class="uk-form uk-container-center uk-form-horizontal" role="form" method="POST" action="{{ url('article') }}">
                    <fieldset data-uk-margin>
                        <legend>新建文章</legend>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="uk-form-row">
                            <label class="uk-form-label">标题</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <div class="uk-form-row">
                            <label class="uk-form-label">摘要</label>
                            <input type="text" class="form-control" name="description" required>
                        </div>
                        <div class="uk-form-row">
                            <label class="uk-form-label">缩略图</label>
                            <input type="text" class="form-control" name="recommend_by" required>
                        </div>
                        <div class="uk-form-row">
                            <label class="uk-form-label">文章类别</label>
                            <div class="uk-button uk-form-select" data-uk-form-select>
                                <span></span>
                                <select name="article_type">
                                    @foreach($types as $type)
                                        <option value="{{$type->id}}">{{$type->type_ch}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="uk-form-row">
                            <button type="submit" class="uk-button uk-button-primary">提交</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('/js/components/form-select.min.js') }}"></script>
@endsection