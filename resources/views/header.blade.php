<header>
    <div class="top">
        <div class="resource">
            <div class="info">社員番号：{{ Auth::user()->number }}</div>
            <div class="info">氏名：{{ Auth::user()->name }}</div>
            <div class="info">役職：{{ Auth::user()->role }}</div>
        </div>
        <form action="{{ route('logout') }}" method="post">
            @csrf
        <button type="submit" class="logout">ログアウト</button>
        </form>
    </div>

</header>
        