@if ($errors->any())
    <div class="alert alert-danger" style="background-color: #ffb3b3">
        <ul style="list-style-type: none;" >
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif