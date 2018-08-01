@extends('frontend::layouts.layout')

@section('content')
    <div class="row">

        <div class="col-md-8">
            <div class="single-post-box">
                <div class="single-post">
                    {{--文章标题--}}
                    <div class="single-post-title">
                        <a class="single-post-category"><i></i>科技</a>
                        <h3>{{ $article->title }}</h3>
                    </div>

                    {{--meta--}}
                    <div class="single-post-meta">
                        <div class="pull-left text-muted">
                            <span class="author">
                                <img src="{{ $article->administrator->avatar }}">
                                <a href="">admin</a>
                            </span>
                            <span class="post-date"><i class="fa fa-calendar"></i>{{ date('Y-m-d', strtotime($article->created_at)) }}</span>
                            <span class="post-tags"><i class="fa fa-tags"></i>
                                @foreach($article->tags as $tag)
                                    <a href="">{{ $tag->name }}</a>
                                @endforeach
                            </span>
                        </div>

                        <div class="pull-right text-muted">
                            <span class="post-comments"><i class="fa fa-comment"></i><a href="#">（100）</a></span>
                            <span class="post-view"><i class="fa fa-eye"></i>（58）</span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    {{--文章内容--}}
                    <div class="single-post-content">
                        {!! $article->content_html !!}
                    </div>
                </div>

                <hr>

                <div class="comment-box">
                    <div class="comment-input">
                        <h4 class="comment-form-title">参与讨论</h4>
                        <div class="input-comment">
                            <form class="comment-form">
                                <div class="comment-form-comment form-group">
                                    <label class="sr-only control-label" for="comment">评论内容</label>
                                    <textarea placeholder="在这里输入评论内容..." class="form-control" id="comment_content" name="comment_content" rows="6" aria-required="true"></textarea>
                                </div>
                                <p class="form-submit text-right">
                                    <button name="submit" class="btn btn-primary" type="button" id="submit-comment">提交评论</button>
                                    <input type="hidden" name="comment_item_type" value="App\Models\Article" id="comment_item_type">
                                    <input type="hidden" name="comment_item_id" value="9488" id="comment_item_id">
                                    <input type="hidden" name="comment_parent_id" id="comment_parent_id" value="0">
                                </p>
                            </form>
                        </div>
                    </div>

                    <div class="comment-list">
                        <div>
                            <h4 class="comment-list-title">文章评论</h4>
                            <hr>
                            <div class="comment-item">
                                <div class="comment-item-meta">
                                    <div class="comment-item-userInfo pull-left">
                                        <img src="{{ $article->administrator->avatar }}" alt="user avatar">
                                        <span class="user-link"><a>用户2</a></span>
                                    </div>

                                    <div class="comment-item-time pull-right">
                                        <span>2018-08-01 23:59:59</span>
                                    </div>

                                    <div class="clearfix"></div>
                                </div>

                                <div class="comment-item-content">
                                    <p>这是评论内容</p>
                                </div>

                                <div class="comment-item-footer">
                                    <button class="">
                                        <i class="fa fa-thumbs-o-up"></i>
                                        335
                                    </button>

                                    <button class="hover-btn">
                                        <i class="fa fa-reply"></i>
                                        回复
                                    </button>

                                    <button class="hover-btn">
                                        <i class="fa fa-thumbs-o-down"></i>
                                        踩
                                    </button>

                                    <button class="hover-btn">
                                        <i class="fa fa-flag"></i>
                                        举报
                                    </button>
                                </div>
                            </div>
                            <div class="comment-item">
                                <div class="comment-item-meta">
                                    <div class="comment-item-userInfo pull-left">
                                        <img src="{{ $article->administrator->avatar }}" alt="user avatar">
                                        <span>
                                            <span class="user-link"><a href="">用户1</a></span>
                                            <span class="comment-reply">回复</span>
                                            <span class="user-link"><a href="">用户2</a></span>
                                        </span>
                                    </div>

                                    <div class="comment-item-time pull-right">
                                        <span>2018-08-01 23:59:59</span>
                                    </div>

                                    <div class="clearfix"></div>
                                </div>

                                <div class="comment-item-content">
                                    <p>这是评论内容</p>
                                </div>

                                <div class="comment-item-footer">
                                    <button class="">
                                        <i class="fa fa-thumbs-o-up"></i>
                                        335
                                    </button>

                                    <button>
                                        <i class="fa fa-comment"></i>
                                        查看对话
                                    </button>

                                    <button class="hover-btn">
                                        <i class="fa fa-reply"></i>
                                        回复
                                    </button>

                                    <button class="hover-btn">
                                        <i class="fa fa-thumbs-o-down"></i>
                                        踩
                                    </button>

                                    <button class="hover-btn">
                                        <i class="fa fa-flag"></i>
                                        举报
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--边栏--}}
        <div class="col-md-4">
            <div class="sidebar">
                <aside id="panel-author" class="panel hidden-xs">
                    <div class="panel-heading">
                        <h3 class="panel-title">关于作者</h3>
                    </div>
                    <div class="panel-body">
                        <div class="author-info">

                        </div>
                    </div>
                </aside>

                <aside id="panel-related" class=" panel hidden-xs">
                    <div class="panel-heading">
                        <h3 class="panel-title">相关推荐</h3>
                    </div>
                    <div class="panel-body">
                        <div class="post-top">

                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>

@endsection


