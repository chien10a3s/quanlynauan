<style>
    .alert:hover{
        background: #55abb5 !important;
    }
</style>
@if (count($all_meal) > 0)
    @foreach ($all_meal as $item_kitchen)
        @if (count($item_kitchen->kitchen) > 0)
            @foreach ($item_kitchen->kitchen as $item_meal)
                @if (count($item_meal->daily_meal) > 0)
                    @foreach ($item_meal->daily_meal as $item_daily_meal)
                        <a href="{{ route('admin.user.double',$item_daily_meal->id) }}">
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