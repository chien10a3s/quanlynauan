<style>
    .food:hover{
        background-color: #258fd7 !important;
        color: #FFFFFF;
    }
</style>
@if(count($option) > 0)
    @foreach($option as $ten_nha_cung_cap=>$arr_food)
        <div class="col-md-{{12/count($option)}}">
            <b style="float: left" class="col-md-12">{{ $ten_nha_cung_cap }}</b>
            @foreach($arr_food as $id=>$item_food)
                <a href="#" style="float:left;padding: 4px;margin: 3px;background: rgba(0, 0, 0, 0.02);" class="col-md-12 food" onclick="select_food({{ $id }},'{{$idclick}}','{{$item_food['name']}}',this)">
                    <div class="avatar" style="float: left;width: 40px;height:40px;margin-right: 10px;">
                        <img style="width: 100%;margin-top: 4px;" src="{{$item_food['image']}}">
                    </div>
                    <div class="name-food col-md-8" >
                        <b role="menuitem" tabindex="-1" href="#" class="col-md-12">{{$item_food['name']}}</b><br>
                        <label role="menuitem" tabindex="-1" href="#" class="col-md-12">{{$item_food['price']}}</label>
                    </div>
                </a>
            @endforeach
        </div>
    @endforeach
@else
    Không có thực phẩm được tìm thấy
@endif