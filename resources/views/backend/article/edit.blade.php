@extends('app')

@section('css')
    <link href="{{ asset('/css/components/form-advanced.almost-flat.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/components/form-select.almost-flat.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/components/form-file.almost-flat.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="uk-grid uk-grid-collapse">
        <div class="uk-width-small-1-3 uk-container-center">
            <div class="uk-panel">
                <form class="uk-form uk-container-center uk-form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ url('article') }}">
                    <fieldset data-uk-margin>
                        <legend>编辑文章</legend>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="uk-form-row">
                            <label class="uk-form-label">标题</label>
                            <input type="text" class="form-control" name="title" value="{{$item->title}}" required>
                        </div>
                        <div class="uk-form-row">
                            <label class="uk-form-label">摘要</label>
                            <input type="text" class="form-control" name="description"  value="{{$item->description}}" required>
                        </div>
                        <div class="uk-form-row">
                            <label class="uk-form-label">缩略图</label>
                            <div class="uk-form-file">点击重新上传缩略图<input name="thumbnail" type="file"></div>
                        </div>
                        <div class="uk-form-row">
                            <label class="uk-form-label">文章链接</label>
                            <input type="text" class="form-control" name="uri" value="{{$item->uri}}" required>
                        </div>
                        <div class="uk-form-row">
                            <label class="uk-form-label">文章类别</label>
                            <div class="uk-button uk-form-select" data-uk-form-select>
                                <span>请选择类别</span>
                                <i class="uk-icon-caret-down"></i>
                                <select name="article_type" required>
                                    @foreach($types as $type)
                                        <option value="{{$type->id}}" {{$type->id == $item->type_id?"selected":""}}>{{$type->type_ch}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="uk-form-row">
                            <button type="submit" class="uk-button uk-button-primary">更新</button>
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