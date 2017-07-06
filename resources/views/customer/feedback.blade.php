<style>
    a, a:hover {
        text-decoration: none !important;
    }

    li {
        list-style: none;
    }

    ul {
        padding-left: 0px;
    }

    .container {
        /*background: #fff;*/
    }

    .left-timeline {
        border: 1px solid rgb(218, 218, 218);
        overflow-y: auto;
        border-radius: 5px !important;
        background: white;
        /*margin-right: 25.6px;*/
    }

    .tile-item {
        text-align: center;
        padding-top: 10px;
    }

    .item-left {
        width: 240px;
        float: left;
        max-width: 100%;
    }

    .item-left .tile-item {
        margin: 0;
        font-size: 16px;
        line-height: 30px;
        text-transform: uppercase;
    }

    .item-left .li {
        list-style: none;
        font-size: 13px;
        border-bottom: 1px solid #eee;
        line-height: 25px;
        padding: 15px 0;
    }

    .item-left ul {
        padding-top: 10px;
    }

    .item-left ul li {
        border-bottom: 1px solid #eee;
        padding-bottom: 15px;
        padding-top: 15px;
    }

    .item-left .value {
        font-weight: 700;
        min-width: 60px;
        float: right;
        text-align: left;
    }

    /*middle*/
    .mid-timeline {
        font-size: 1.5rem;
    }

    .post-item {
        background-color: white;
        /*border: 1px solid rgb(218, 218, 218);*/
        /*box-shadow: rgba(0, 0, 0, 0.05) 0px 1px 3px 0px;*/
        /*border-radius: 5px !important;*/
        /*margin: 0px 0px 1.6rem 0px;*/
        /*padding: 15px;*/
    }

    .item-header {
        margin: 1.6rem;
        margin-left: 0px !important;
        cursor: default;
    }

    .img-circle {
        width: 4.2rem;
        height: 4.2rem;
        border: 1px solid #ddd;
    }

    .comments-item-child {
        padding-top: 25px;
        padding-left: 65px;
    }

    .comments-item-child .img-circle {
        width: 3.5rem;
        height: 3.5rem;
    }

    .comments-item-child .comments-date a {
        font-size: 1.1rem;
    }

    .comments-item-child .comments-content {
        margin-left: 4rem;
        font-size: 1.1rem;
    }

    .comments-item-child-new .img-circle {
        width: 3.5rem;
        height: 3.5rem;
    }

    .comments-item-child-new {
        padding-top: 20px;
        padding-left: 65px;
    }

    .header-avatar {
        float: left;
        margin-right: 10px;
    }

    .header-name a {
        color: rgb(54, 54, 54);
        font-weight: 600;
        font-size: 1.6rem;
        margin-bottom: 0.2rem;
    }

    .header-name {
        float: left;
    }

    .content {
        background-repeat: no-repeat;
        position: relative;
        margin: 0px -1px;
    }

    .like-comments .like {
        user-select: none;
        cursor: pointer;
        font-family: ProximaNova, "Helvetica Neue", Helvetica, Arial, sans-serif;
        color: rgb(140, 140, 140);
        font-size: 1.4rem;
        margin-right: 25.6px;
        float: left;
    }

    .button-like {
        display: inline-block;
        cursor: pointer;
        border: 1px solid rgb(218, 218, 218);
        border-radius: 5px !important;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 2px 0px;
        line-height: 0;
        padding: 0.7rem 0.8rem 0.7rem 0.8rem;
    }

    .liked {
        background-color: rgb(245, 245, 243);
    }

    .button-like:hover, .button-comment:hover {
        background: rgb(245, 245, 243);
    }

    .button-comment {
        display: inline-block;
        cursor: pointer;
        border: 1px solid rgb(218, 218, 218);
        border-radius: 5px !important;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 2px 0px;
        line-height: 0;
        padding: 0.7rem 0.8rem 0.7rem 0.8rem;
    }

    .button-action span {
        font-size: 1.4rem;
        color: rgb(140, 140, 140);
        margin-right: 1rem;
        position: relative;
        top: 1px;
    }

    .comments-item, .comments-item-new {
        position: relative;
        border-top: 1px solid rgb(218, 218, 218);
        padding: 1.6rem 0;
        font-size: 1.6rem;
        line-height: 1.2;
        margin-top: 1rem;
    }

    .comments-avatar {
        float: left;
        margin-right: 10px;
    }

    .comments-date a {
        color: rgb(54, 54, 54);
        font-weight: 500;
        font-size: 1.2rem;
        margin-bottom: 0.2rem;
    }

    .comments-date {
        float: left;
    }

    .comments-content {
        color: rgb(103, 103, 103);
        font-size: 1.2rem;
        padding-top: 5px;
        line-height: 23px;
        margin-left: 5rem;
    }

    .comments-create textarea {
        box-sizing: border-box;
        overflow-y: auto;
        height: 100%;
        resize: none;
        margin: 0px;
        outline: 0px;
        padding: 10px;
        background: transparent;
        white-space: pre-wrap;
        word-wrap: break-word;
        font-family: inherit;
    }

    .new-post {
        position: relative;
        border: 1px solid rgb(0, 174, 239);
        border-radius: 0.5rem;
        background-color: white;
        margin-bottom: 1.6rem;
    }

    .post-avatar {
        float: left;
        margin-right: 10px;
    }

    .post-content {
        float: left;
    }

    .new-post textarea {
        outline: 0px;
        border: 0px;
        padding: 15px 10px;
        background: transparent;
        white-space: pre-wrap;
        word-wrap: break-word;
        font-size: inherit;
        font-family: inherit;
        max-height: none;;
        resize: vertical;
    }

    .new-post img {
        /*margin-right: 15px;*/
    }

    .tool-upload {
        border-top: 1px solid rgb(218, 218, 218);
        opacity: 1;
        transition: opacity 0.3s ease-in-out;
    }

    .new-comment {
        position: relative;
        /*border: 1px solid rgb(0, 174, 239);*/
        border-radius: 0.5rem;
        background-color: white;
        /*margin-bottom: 1.6rem;*/
    }

    .new-comment img {
        margin-right: 15px;
    }

    .new-comment textarea {
        outline: 0px;
        box-shadow: rgba(0, 0, 0, 0.15) 0px 1px 3px 0px inset;
        border: 1px solid rgb(218, 218, 218);
        padding: 13px 8px;
        background: transparent;
        white-space: pre-wrap;
        word-wrap: break-word;
        font-family: inherit;
        max-height: none;;
        resize: vertical;
        font-size: 14px;
    }

    .color-learned {
        color: #989898;
    }

    .image {
        position: relative;
        margin-right: 15px;
        float: left;
        margin-top: 10px;
    }

    img.delete {
        position: absolute;
        top: 0;
        right: 0;
        text-indent: -999px;
        cursor: pointer;
    }

    .image:hover img.delete {
        display: block;
    }
</style>
<div class="page-content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel-bordered">
                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"/>
                <div class="panel-body">
                    <div class="post-item">
                        <div class="tool">
                            <div class="like-comments">
                                <div class="like">
                                    <img src="/social/comment-icon.png">
                                    <span style="font-size: 1.3rem" id="count-feedback">{{@$data['count_feedback']}}
                                        phản hồi</span>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        @if(!empty($data['daily_meal_id']))
                            <div class="list-comments">
                                <div class="content-parent">
                                    @foreach($data['feedback'] as $key => $feedback)
                                        <div class="comments-item">
                                            <div class="comment-header">
                                                <div class="comments-avatar">
                                                    <img class="img-responsive img-circle"
                                                         src="{{ asset( $feedback['avatar'] ) }}">
                                                </div>
                                                <div class="comments-date">
                                                    <a>{{@$feedback['user']}}</a>
                                                    <div style="color: rgb(140, 140, 140); font-size: 1rem; padding-top: 4px;">
                                                        {{ @$feedback['date'] }}
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="comments-content">
                                                {{@$feedback['content']}}
                                            </div>

                                            <div class="content-child">
                                                @foreach($feedback['child'] as $key_child => $child)
                                                    <div class="comments-item-child">
                                                        <div class="comment-header">
                                                            <div class="comments-avatar">
                                                                <img class="img-responsive img-circle"
                                                                     src="{{ asset( $child['avatar'] ) }}">
                                                            </div>
                                                            <div class="comments-date">
                                                                <a>{{@$child['user']}}</a>
                                                                <div style="color: rgb(140, 140, 140); font-size: 1rem; padding-top: 4px;">
                                                                    {{@$child['date']}}
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="comments-content">
                                                            {{@$child['content']}}
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="comments-item-child-new">
                                                <div class="new-comment">
                                                    <div style="padding: 0 0 12px; display: inline-flex;">
                                                        <img class="img-responsive img-circle"
                                                             src="{{ asset( Auth()->user()->avatar ) }}">
                                                        <textarea id="0" class="enter-comment"
                                                                  data-parent_id="{{@$feedback['id']}}"
                                                                  placeholder="Nhập phản hồi..." rows="1"
                                                                  cols="60"></textarea>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="comments-item-new"
                                     style="padding-top: 5px !important; padding-bottom: 5px !important;">
                                    <div class="new-comment">
                                        <div style="padding: 0 0 12px; display: inline-flex;">
                                            <img class="img-responsive img-circle"
                                                 src="{{ asset( Auth()->user()->avatar ) }}">
                                            <textarea id="0" class="enter-comment-parent" data-parent_id="0"
                                                      placeholder="Nhập phản hồi..." rows="1"
                                                      cols="60"></textarea>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- DataTables -->
<script src="/js/jquery-number-master/jquery.number.min.js"></script>
<script>

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
        });
        $('.date_meal').html('Bữa ăn ngày {{ @$date }}');
        $('.number-format').number(true);
        newFeedbackParent();
        newFeedback();
        //create new feedback
        function newFeedback() {
            $(".enter-comment").keypress(function (e) {
                var daily_meal_id = {{@$data['daily_meal_id']}};
                var parent_id = $(this).attr('data-parent_id');
                var _token = $("#_token").val();
                var key = e.which;
                if (key == 13) {
                    e.preventDefault();
                    $.ajax({
                        method: "POST",
                        async: false,
                        url: '{{route('admin.account.feedback.store')}}',
                        data: {
                            'daily_meal_id': daily_meal_id,
                            'parent_id': parent_id,
                            '_token': _token,
                            'content': $(this).val()
                        },
                        success: function (data) {
                            $(e.target).val(null);
                            $(e.target).closest('.comments-item').find('.content-child').append('<div class="comments-item-child"><div class="comment-header">' +
                                '<div class="comments-avatar"><img class="img-responsive img-circle" src="' + data.feedback.avatar + '"></div>' +
                                '<div class="comments-date"><a>' + data.feedback.user + '</a>' +
                                '<div style="color: rgb(140, 140, 140); font-size: 1rem; padding-top: 4px;">' + data.feedback.date + '</div></div>' +
                                '<div class="clearfix"></div></div>' +
                                '<div class="comments-content">' + data.feedback.content + '</div>' +
                                '</div>');

                            $("#count-feedback").text(data.count_feedback + ' phản hồi');
                        }
                    });
                }
            });
        }

        //create new feedback parent
        function newFeedbackParent() {
            $(".enter-comment-parent").keypress(function (e) {
                var daily_meal_id = {{@$data['daily_meal_id']}};
                var parent_id = $(this).attr('data-parent_id');
                var _token = $("#_token").val();
                var key = e.which;
                if (key == 13) {
                    e.preventDefault();
                    $.ajax({
                        method: "POST",
                        async: false,
                        url: '{{route('admin.account.feedback.store')}}',
                        data: {
                            'daily_meal_id': daily_meal_id,
                            'parent_id': parent_id,
                            '_token': _token,
                            'content': $(this).val()
                        },
                        success: function (data) {
                            console.log(data);
                            $(e.target).val(null);
                            $(e.target).closest('.list-comments').find('.content-parent').append('<div class="comments-item"><div class="comment-header">' +
                                '<div class="comments-avatar"><img class="img-responsive img-circle" src="' + data.feedback.avatar + '"></div>' +
                                '<div class="comments-date"><a>' + data.feedback.user + '</a>' +
                                '<div style="color: rgb(140, 140, 140); font-size: 1rem; padding-top: 4px;">' + data.feedback.date + '</div></div>' +
                                '<div class="clearfix"></div></div>' +
                                '<div class="comments-content">' + data.feedback.content + '</div>' +
                                '<div class="content-child"></div><div class="comments-item-child-new">' +
                                '<div class="new-comment">' +
                                '<div style="padding: 0 0 12px; display: inline-flex;">' +
                                '<img class="img-responsive img-circle" src="' + data.feedback.avatar + '">' +
                                '<textarea id="0" class="enter-comment" data-parent_id="' + data.feedback.id + '" placeholder="Nhập phản hồi..." rows="1" cols="60"></textarea>' +
                                '<div class="clearfix"></div>' +
                                '</div></div></div></div>'
                            );
                            $("#count-feedback").text(data.count_feedback + ' phản hồi');
                            newFeedback();
                        }
                    });
                }
            });
        }

    });
</script>