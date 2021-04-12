    @extends('app')

@section('content')

<div class=create-container>
    <div class='create-header clearfix'>
        <div class='articul'>Артикул</div>
        <div class='name'>Наименование</div>
        <div class='status'>Статус</div>
        <div class='button-edit'></div>
    </div>
    
    <div class='create-form clearfix'>
        <form method="POST" action="/create">
            @csrf
            <div class='articul'><input type ="text" name="art" size="10" maxlength="200"> </div>
            <div class='name'><input type ="text" name="name" size="40" maxlength="500"> </div>
            <div class='status'>
                <select name="status">
                        <option value="available" selected="selected">available</option>
                        <option value="unavailable">unavailable</option>
                </select>
            </div>
            <div class='button-edit'><input type ="submit" value="Обновить"> </div>
        </form>
    </div>
 </div>

<div class="error">
    @if($errors->any())
    {{ implode('', $errors->all(':message')) }}
    @endif
</div>
<div class="success">
    {{ session('message') }}
</div>

<div class=edit-container>
    <div class='edit-header clearfix'>
        <div class='articul'>Артикул</div>
        <div class='name'>Наименование</div>
        <div class='status'>Статус</div>
        <div class='button-edit'></div>
    </div>
    
    <?php $i=0?>
    @foreach ($products as $product)    
    <div class="edit-form clearfix">
        <form method="POST" action="/edit">
            @csrf
            <div class='articul'><input type ="text" name="art" value="{{$product->art}}" size="10" maxlength="200"> </div>
            <div class='name'><input type ="text" name="name" value="{{$product->name}}" size="40" maxlength="500"> </div>
            <input type ="hidden" name="id" value="{{$product->id}}"> 
            <div class='status'>
                <select name="status">
                    @if ($product->status == "available")
                        <option value="available" selected="selected">available</option>
                        <option value="unavailable">unavailable</option>
                    @else
                        <option value="available">available</option>
                        <option value="unavailable" selected="selected">unavailable</option>
                    @endif
                </select>
            </div>
            <div class='button-edit'><input type ="submit" value="Обновить"> </div>
        </form>
        <form method="POST" action="/delete">
            @csrf
            <input type ="hidden" name="id" value="{{$product->id}}"> 
            <div class='button-delete'><input type ="submit" value="Удалить"> </div>
        </form>
    </div>
    @endforeach
 </div>

@stop
