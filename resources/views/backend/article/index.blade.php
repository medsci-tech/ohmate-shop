@extends('app')

@section('css')
    <link href="{{ asset('/css/components/form-advanced.almost-flat.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/components/form-select.almost-flat.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/components/slidenav.almost-flat.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/components/dotnav.almost-flat.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/components/search.almost-flat.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
@endsection

@section('content')
    <div class="uk-grid uk-grid-collapse">
        <div class="uk-width-small-3-3 uk-container-center">
            <div class="uk-panel">
                <a href="{{url('/article/create')}}" class="uk-button uk-button-primary"><i class="uk-icon uk-icon-plus"></i> 新增项目</a>
                <div style="display: inline-block;" id="search">
                    <form class="uk-search" data-uk-search action="{{url('/article/search')}}">
                        <input class="uk-search-field uk-form-width-large" type="search" name="key" placeholder="在此输入搜索...">
                    </form>
                </div>
                <table class="uk-table uk-table-hover uk-table-striped">
                    <caption>文章列表</caption>
                    <thead>
                    <tr>
                        <th>编号</th>
                        <th>标题</th>
                        <th>缩略图</th>
                        <th>发布时间</th>
                        <th>文章类别</th>
                        <th>发布者</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>编号</th>
                        <th>标题</th>
                        <th>缩略图</th>
                        <th>发布时间</th>
                        <th>文章类别</th>
                        <th>发布者</th>
                        <th>操作</th>
                    </tr>
                    </tfoot>
                    <tbody>

                    @foreach($items as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->title}}</td>
                            <td><a class="uk-button{{($item->thumbnail)?'':' uk-text-danger'}}" href="{{$item->thumbnail}}" data-uk-lightbox="{group:'group-{{$item->id}}'}"  data-lightbox-type="image" title="缩略图">缩略图</a></td>
                            <td>{{$item->created_at}}</td>
                            <td>
                                @if($item->type_id == 1)
                                    <div class="uk-badge uk-badge-notification" style="background-color: #8a2be2">糖友科普</div>
                                @elseif($item->type_id == 2)
                                    <div class="uk-badge uk-badge-notification" style="background-color: #9acd32">药物治疗</div>
                                @elseif($item->type_id == 3)
                                    <div class="uk-badge uk-badge-notification" style="background-color: #cd853f">膳食营养</div>
                                @elseif($item->type_id == 4)
                                    <div class="uk-badge uk-badge-notification" style="background-color: #0077dd">合理运动</div>
                                @elseif($item->type_id == 5)
                                    <div class="uk-badge uk-badge-notification" style="background-color: #f9a124">血糖检测</div>
                                @else
                                    <div class="uk-badge uk-badge-danger" style="background-color: #5e5e5e">
                                        未知类型
                                    </div>
                                @endif
                            </td>
                            <td>{{$item->user? $item->user->name: '未知'}}</td>
                            <td>
                                <div style="display: inline-block; position: relative;" data-uk-dropdown="{mode:'click'}">
                                    <button class="uk-button">
                                    操作
                                    <i class="uk-icon-caret-down"></i>
                                    </button>
                                    <div class="uk-dropdown">
                                        <ul class="uk-nav uk-nav-dropdown">
                                            <li><a class="uk-text-info" href="{{url('article/'. $item->id . '/edit')}}">编辑</a></li>
                                            <li><a class="uk-text-danger" href="{{url('article/'. $item->id . '/delete')}}">删除</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $items->render() !!}
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('/js/components/form-select.min.js') }}"></script>
    <script src="{{ asset('/js/core/dropdown.min.js') }}"></script>
    <script src="{{ asset('/js/components/lightbox.min.js') }}"></script>
    <script src="{{ asset('/js/components/search.min.js') }}"></script>
@endsection