@extends('app')

@section('css')
    <link href="{{ asset('/css/components/form-advanced.almost-flat.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/components/form-select.almost-flat.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="uk-grid uk-grid-collapse">
        <div class="uk-width-small-1-3 uk-container-center">
            <div class="uk-panel">
                <form class="uk-form uk-container-center uk-form-horizontal" role="form" method="POST" action="{{ url('admin/walkers') }}">
                    <fieldset data-uk-margin>
                        <legend>基本信息</legend>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="uk-form-row">
                            <label  class="uk-form-label">姓名</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="uk-form-row">
                            <label  class="uk-form-label">电话号码</label>
                            <input type="text" class="form-control" name="phone" required>
                        </div>
                        <div class="uk-form-row">
                            <label  class="uk-form-label">推荐人</label>
                            <input type="text" class="form-control" name="recommend_by" required>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>附加信息</legend>
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