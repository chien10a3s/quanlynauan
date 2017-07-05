<style>
    .alert:hover{
        background: #55abb5 !important;
    }
</style>
{{--//Modal Detail--}}

@if (count($all_meal) > 0)
    @foreach ($all_meal as $item_kitchen)
        @if (count($item_kitchen->kitchen) > 0)
            @foreach ($item_kitchen->kitchen as $item_meal)
                @if (count($item_meal->daily_meal) > 0)
                    @foreach ($item_meal->daily_meal as $item_daily_meal)
                        <a href="#" onclick="view_detail({{$item_daily_meal->id}})" >
                            <div class="alert alert-info fade in alert-dismissable" style="margin-top:18px;">
                                Bữa ăn thứ {{ @$day_of_week[\Carbon\Carbon::parse($item_daily_meal->day)->dayOfWeek] }}
                                ngày {{ \Carbon\Carbon::parse($item_daily_meal->day)->format('d/m/Y') }}
                            </div>
                        </a>
                    @endforeach
                @endif
            @endforeach
        @endif
    @endforeach
@endif
<script>
    function view_detail(id_meal) {
//        $('#select_meal').modal('hide');
//        alert(id_meal);
        $("#detail_meal").modal();
        $.ajax({
            method: "get",
            async: false,
            url: '{{route('admin.user.ajax_view_detail')}}',
            data: {
                'daily_meal_id': id_meal
            },
            success: function (data) {
                $("#data_result_detail").html(data);
            }
        });
    }
</script>