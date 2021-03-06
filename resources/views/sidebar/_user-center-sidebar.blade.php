<div class="col-lg-4 right">

    <div class="part user-info">

        <div class="user-center-avatar">
            <img src="http://qingqu.test/uploads/images/posts/202003/03/ooxx_1583234915_kdaTMz.jpeg" alt="">
        </div>

        <div class="user-center-name">
            <span>{{$user->name}}</span>
        </div>
        <div class="user-center-level">
            <span class="badge badge-warning">Level.69</span>
            <span class="badge badge-danger">VIP.9</span>
        </div>
        <div class="user-center-description">
            <p>本站创始人，维护者。</p>
            <p>不用管什么东西，本身就是喜欢，你能说什么呢。对不对，就问你对不对吧。是不是呀。你肯定说是，我肯定说不是。爱是不是。</p>
        </div>
    </div>

    <div class="part user-center-follow">

        <li><strong>69</strong><span><a href="{{route('user.followings',$user)}}">关注</a></span></li>
        <li><strong>96</strong><span><a href="{{route('user.followers',$user)}}">粉丝</a></span></li>
        <li><strong>{{$user->bubble_count}}</strong><span>冒泡</span></li>
        <li><strong>6969</strong><span>人气</span></li>



            @can('follow', $user)
                <div class="follow">
                    @if (Auth::user()->isFollowing($user->id))
                        <form action="{{ route('followers.destroy', $user) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-primary">取消关注</button>
                        </form>
                    @else
                        <form action="{{ route('followers.store', $user) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-pink">关注</button>
                        </form>
                    @endif
                </div>
            @endcan




    </div>

    <div class="part widget widget-gift">
        <div class="title">收到的礼物</div>
        <div class="content">礼物礼物礼物</div>

    </div>

    @include('widgets.categories')

</div>