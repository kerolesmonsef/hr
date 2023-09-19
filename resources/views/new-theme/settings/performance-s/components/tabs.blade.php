<div class="tabsS1" style="width: fit-content;">
    <ul class="nav nav-pills mb-3 scrollS2" id="pills-tab" role="tablist" style="padding: 0px 10px;">
        <li class="nav-item" role="presentation">
            <a href="{{ route("PerformanceFactor.index") }}" class="nav-link {{ $active == "Factors" ? "active" : "" }}" role="tab" aria-controls="branches" aria-selected="true">@lang("Performance Factors")</a>
        </li>
        <li class="nav-item" role="presentation">
            <a href="{{ route("PerformancePeriod.index") }}" class="nav-link {{ $active == "Period" ? "active" : "" }}" role="tab" aria-controls="pills-Notes" aria-selected="false">@lang("Performance Period")</a>
        </li>
    </ul>
</div>

<div class="tab-content" id="pills-tabContent">
    {!! $slot !!}
</div>