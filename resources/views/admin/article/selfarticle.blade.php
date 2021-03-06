@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{asset('resources/assets/sass/blade.css')}}">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">我的文章</div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                {!! implode('<br>', $errors->all()) !!}
                            </div>
                        @endif
                        {{--<a href="{{ url('admin/article/create') }}" class="btn btn-lg btn-primary">新增</a>--}}
                        @foreach ($user as $article)
                            {{--<hr>--}}
                            <div class="article">
                                <h4>標題：{{ $article->title }}</h4>
                                <div class="content">
                                    <p>
                                        類別：@if($article->event==0)金援 @elseif($article->event==1)人力 @else物資 @endif<br>
                                        需求量：@if($article->demand==0)小 @elseif($article->demand==1)中 @else大 @endif<br>
                                        地址：{{ $article->address }}<br>
                                        內容：{{ $article->body }}
                                        {{ $article->user }}
                                    </p>
                                </div>
                            </div>
                            <a href="{{ url('admin/article/'.$article->id.'/edit') }}" class="btn btn-success">編輯</a>
                            <form action="{{ url('admin/article/'.$article->id) }}" method="POST" style="display: inline;">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger">刪除</button>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection