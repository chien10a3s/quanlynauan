$(e.target).closest('.list-comments').append('<div class="comments-item-child">'+
    +'<div class="comment-header">'+
        +' <div class="comments-avatar">'+
            +'<img class="img-responsive img-circle" src="{{ asset( $child->create_user->avatar ) }}"></div>'+
        +'<div class="comments-date">'+
            +'<a>'+data.feedback.create_user.name+'</a>'+
            +'<div style="color: rgb(140, 140, 140); font-size: 1rem; padding-top: 4px;">'+
                +'{{ (isset($child->created_at)) ? \Carbon\Carbon::parse($child->created_at)->format('H:i d/m/Y') : null }}'+
                +'</div>'+
            +'</div>'+
        +'<div class="clearfix"></div></div>'+
    +'<div class="comments-content">{{@$child->content}}</div>'+
    +'</div>');