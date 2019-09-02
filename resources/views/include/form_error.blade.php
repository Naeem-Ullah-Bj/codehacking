<div>
    @if(count($errors)>0)
        <div class="alert-danger col-sm-8">
            <ul>
                @foreach($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                @endforeach()
            </ul>
        </div>
    @endif()
</div>