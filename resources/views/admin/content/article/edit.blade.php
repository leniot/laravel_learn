@extends('admin::layouts.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            文章
            <small>编辑</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> articles</a></li>
            <li class="active"> edit</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-widget">
                    <div class="box-header with-border">
                        <a href="{{ admin_base_path('content/articles') }}" class="btn btn-default">
                            <i class="fa fa-arrow-left"></i> 返回
                        </a>
                    </div>
                    <form class="form-horizontal" action="{{ admin_base_path('content/articles').'/'.$article->id }}" method="post" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="box-body">
                            <div class="fields-group">
                                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label for="title" class="col-sm-3 control-label">文 章 标 题：</label>

                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="title" name="title" placeholder="文章标题" value="{{ $article->title }}">
                                    </div>

                                    @if ($errors->has('title'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('title') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('category') ? ' has-error' : '' }}">
                                    <label for="category" class="col-sm-3 control-label">文 章 类 别：</label>

                                    <div class="col-sm-8">
                                        <select class="form-control select2" style="width: 100%;" name="category">
                                            <option value="">-- 选 择 文 章 类 别 --</option>
                                            @foreach($categoryList as $category)
                                                <option value="{{ $category->id }}" @if($article->category_id == $category->id) {{ 'selected' }} @endif>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @if ($errors->has('category'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('category') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('tags') ? ' has-error' : '' }}">
                                    <label for="tags" class="col-sm-3 control-label">标 签：</label>

                                    <div class="col-sm-8">
                                        <select class="form-control select2" style="width: 100%;" name="tags[]" data-placeholder="选 择 标 签" multiple>
                                            @foreach($tagList as $tag)
                                                <option @foreach($article->tags as $a_tag)
                                                        @if($tag->id == $a_tag->id)
                                                        {{ 'selected' }}
                                                        @endif
                                                        @endforeach value="{{ $tag->id }}">{{ $tag->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @if ($errors->has('tags'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('tags') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('keywords') ? ' has-error' : '' }}">
                                    <label for="keywords" class="col-sm-3 control-label">关 键 词：</label>

                                    <div class="col-sm-8">
                                        <input id="keywords" class="form-control" name="keywords" value="{{ $article->keywords }}"
                                               placeholder="多个关键词使用符号（&）隔开">
                                    </div>

                                    @if ($errors->has('keywords'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('keywords') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('cover_image') ? ' has-error' : '' }}">
                                    <label for="keywords" class="col-sm-3 control-label">封 面 图：</label>

                                    <div class="col-sm-8">
                                        <div class="fileinput @if($article->cover_image) fileinput-exists @else fileinput-new @endif" data-provides="fileinput">
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                                <img alt="cover_image" src="{{ asset(Storage::url($article->cover_image)) }}" style="max-height: 140px;">
                                                {{--<input type="hidden" name="cover_image" value="{{ $administrator->avatar }}">--}}
                                            </div>
                                            <div>
                                            <span class="btn btn-default btn-file">
                                                <span class="fileinput-new">上 传</span>
                                                <span class="fileinput-exists">更 换</span>
                                                <input type="file" name="cover_image">
                                            </span>
                                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">移 除</a>
                                            </div>
                                        </div>
                                        {{--<div class="fileinput @if($article->cover_image) fileinput-exists @else fileinput-new @endif" data-provides="fileinput">--}}
                                            {{--<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">--}}
                                                {{--<img alt="cover_image" src="{{ asset(Storage::url($article->cover_image)) }}" style="max-height: 140px;">--}}
                                            {{--</div>--}}
                                            {{--<div>--}}
                                                {{--<span class="btn btn-default btn-file">--}}
                                                    {{--<span class="fileinput-new">上 传</span>--}}
                                                    {{--<span class="fileinput-exists">更 换</span>--}}
                                                    {{--<input type="file" name="cover_image">--}}
                                                {{--</span>--}}
                                                {{--<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">移 除</a>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    </div>

                                    @if ($errors->has('cover_image'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('cover_image') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                                    <label for="description" class="col-sm-3 control-label">描 述：</label>

                                    <div class="col-sm-8">
                                        <textarea id="description" class="form-control" name="description" placeholder="文 章 描 述">{{ $article->description }}</textarea>
                                    </div>

                                    @if ($errors->has('description'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('description') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('content') ? ' has-error' : '' }}">
                                    <label for="content" class="col-sm-3 control-label">正 文：</label>

                                    <div class="col-sm-8">
                                        <div id="test-editormd" style="z-index: 1000;">
                                            <textarea type="text" class="markdown hide" id="content" name="content">{{ $article->content_markdown }}</textarea>
                                        </div>
                                    </div>

                                    @if ($errors->has('content'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('content') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('is_top') ? ' has-error' : '' }}">
                                    <label for="is_top" class="col-sm-3 control-label">是 否 置 顶：</label>

                                    <div class="col-sm-8">
                                        <input id="is_top" name="is_top" type="checkbox" class="minimal-red" @if($article->content == 1) checked="checked" @endif>
                                    </div>

                                    @if ($errors->has('is_top'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('is_top') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <div class="col-sm-offset-3 col-sm-8">
                                <button type="reset" class="btn btn-warning pull-left">
                                    <i class="fa fa-rotate-left"></i> 撤 销
                                </button>
                                <button type="submit" class="btn btn-primary pull-right">
                                    <i class="fa fa-save"></i> 提 交
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->

    <script type="text/javascript" charset="UTF-8">
        $(function () {
            //select2
            $('.select2').select2();
        });

        var testEditor;

        testEditor = editormd("test-editormd", {
            width     : "100%",
            height    : 350,
            toc       : true,
            //atLink    : false,    // disable @link
            //emailLink : false,    // disable email address auto link
            todoList  : true,
            // placeholder: '输入文章内容',
            toolbarAutoFixed: false,
            path      : '{{ asset('/js_expand/editormd/lib') }}/',
            // emoji: true,
            toolbarIcons : ['undo', 'redo', 'bold', 'del', 'italic', 'quote', 'uppercase', 'h1',
                'h2', 'h3', 'h4', 'h5', 'h6', 'list-ul', 'list-ol', 'hr', 'link', 'reference-link',
                'image', 'code', 'code-block', 'table', 'html-entities', 'watch', 'preview', 'search'],
            imageUpload: true,
            imageUploadURL : '{{ admin_base_path('content/articles/uploadImage') }}',
        });

        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass   : 'iradio_minimal-red'
        })
    </script>

@endsection