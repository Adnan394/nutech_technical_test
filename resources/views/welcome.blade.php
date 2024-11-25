@extends('layouts.app')

@section('content')
<div class="main p-3">
    @php
        $user = Auth::user();
    @endphp
    @if ($user)
    <p>User Login : {{ Auth::user()->name }}</p>
    @endif
    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolor neque fuga, expedita eligendi culpa consectetur laborum pariatur cum voluptatem at voluptatibus tempora voluptatum porro voluptas veniam corporis delectus architecto blanditiis exercitationem placeat reiciendis! Praesentium, nesciunt beatae doloribus qui explicabo fugiat temporibus minus aspernatur nam exercitationem tempore consectetur quod voluptates esse necessitatibus nulla atque! Incidunt ad quasi sint similique asperiores. Enim, temporibus suscipit quibusdam, architecto nesciunt molestiae modi voluptatum rerum porro illo dicta officia exercitationem nulla similique reiciendis, laborum eaque saepe? Minima animi iusto voluptas non ad hic quibusdam laborum dolores deserunt unde impedit, sequi sint. Optio, veniam voluptates. Delectus, dicta.
</div>
@endsection