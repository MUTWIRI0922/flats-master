@extends('layouts.app')
@section('title', 'Reports & Analytics')
@section('content')
<style>
    .analytics-dashboard {
        --report-ink: #102a4c;
        --report-muted: #6e829b;
        --report-border: #dce5ee;
        min-height: calc(100vh - 40px);
        margin: -24px;
        padding: 16px 12px 24px;
        color: var(--report-ink);
        background: #eff5f9;
    }

    .page-controls .form-select, .page-controls .btn { min-height: 30px; padding-top: 4px; padding-bottom: 4px; font-size: 0.65rem; }
    .page-controls .form-select { width: auto; border-color: var(--report-border); }
    .analytics-kpis { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 10px; margin-bottom: 12px; }
    .analytics-kpi, .analytics-panel { min-width: 0; background: #fff; border: 1px solid var(--report-border); border-radius: 7px; }
    .analytics-kpi { min-height: 64px; padding: 11px 12px; }
    .analytics-kpi__value { margin: 0; color: #071d3b; font-size: 0.86rem; font-weight: 700; line-height: 1.2; }
    .analytics-kpi__change, .analytics-kpi__label { margin: 4px 0 0; color: var(--report-muted); font-size: 0.55rem; line-height: 1.25; }
    .analytics-kpi__change--positive { color: #08a979; }
    .analytics-kpi__change--negative { color: #e34d62; }
    .analytics-panels { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px; }
    .analytics-panel { min-height: 193px; padding: 12px; }
    .analytics-panel__title { margin: 0; font-size: 0.7rem; font-weight: 700; }
    .analytics-panel__subtitle { margin: 3px 0 0; color: var(--report-muted); font-size: 0.57rem; }
    .analytics-chart { display: block; width: 100%; height: 132px; margin-top: 8px; overflow: visible; }
    .analytics-chart text { fill: #8295ad; font-family: inherit; font-size: 9px; }
    .analytics-chart .chart-grid { stroke: #e8eef4; stroke-dasharray: 2 3; stroke-width: 1; }
    .analytics-legend { display: flex; justify-content: center; gap: 12px; margin-top: -1px; color: var(--report-muted); font-size: 0.52rem; }
    .analytics-legend__item { display: inline-flex; align-items: center; gap: 4px; }
    .analytics-legend__swatch { width: 6px; height: 6px; border-radius: 1px; }
    .property-chart-layout { display: grid; grid-template-columns: 105px minmax(0, 1fr); align-items: center; gap: 8px; margin-top: 9px; }
    .property-chart { width: 105px; height: 105px; }
    .property-legend { display: grid; gap: 7px; }
    .property-legend__row { display: grid; grid-template-columns: minmax(0, 1fr) auto; align-items: center; gap: 7px; color: var(--report-muted); font-size: 0.55rem; }
    .property-legend__name { display: flex; min-width: 0; align-items: center; gap: 5px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    .property-legend__value { color: var(--report-ink); font-weight: 600; white-space: nowrap; }
    @media (max-width: 620px) { .analytics-panels { grid-template-columns: minmax(0, 1fr); } }
    @media (max-width: 480px) {
        .analytics-header { flex-direction: column; }
        .analytics-kpis { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }
    @media (max-width: 350px) {
        .analytics-kpis { grid-template-columns: minmax(0, 1fr); }
        .analytics-controls { width: 100%; }
    }
    @media print {
        .analytics-controls { display: none; }
        .analytics-dashboard { margin: 0; background: #fff; }
    }
</style>
<div class="main-page">
    @include('user.sidebar')    
    <main class="main-content">

        <header class="topbar">
            <h1 class="page-title"></h1>

            <div class="profile">
                <div>
                    <a href=""><i class="bi bi-bell fs-4"></i></a>
                    </div>
                    <img class="avatar" src="{{ Auth::user()->profile_photo_url ?? 'https://via.placeholder.com/40' }}" alt="Profile">
                <div class="profile-name">{{ Auth::user()->name ?? 'User' }}</div>
            </div>
        </header>
        <section class="content">
            <div class="analytics-dashboard">
                <div class="page-header">
                    <div>
                        <h2 class="title">Reports & Analytics</h2>
                        <p class="subtitle">Portfolio performance overview</p>
                    </div>
                    <div class="page-controls">
                        <select class="form-select form-select-sm" aria-label="Report period">
                            <option>Last 6 Months</option>
                            <option>Last 30 Days</option>
                            <option>Year to Date</option>
                        </select>
                        <button type="button" class="btn btn-light btn-sm border" onclick="window.print()"><i class="bi bi-file-earmark-pdf me-1" aria-hidden="true"></i>Export PDF</button>
                    </div>
                </div>

                <div class="analytics-kpis">
                    <article class="analytics-kpi"><p class="analytics-kpi__value">KES 1.45M</p><p class="analytics-kpi__change analytics-kpi__change--positive">+8.4% vs prior period</p><p class="analytics-kpi__label">Total Revenue (6M)</p></article>
                    <article class="analytics-kpi"><p class="analytics-kpi__value">91.8%</p><p class="analytics-kpi__change analytics-kpi__change--positive">+1.2% vs prior period</p><p class="analytics-kpi__label">Avg Occupancy Rate</p></article>
                    <article class="analytics-kpi"><p class="analytics-kpi__value">KES 280K</p><p class="analytics-kpi__change analytics-kpi__change--negative">-12.5% vs prior period</p><p class="analytics-kpi__label">Total Expenses (6M)</p></article>
                    <article class="analytics-kpi"><p class="analytics-kpi__value">KES 1.17M</p><p class="analytics-kpi__change analytics-kpi__change--positive">+7.1% vs prior period</p><p class="analytics-kpi__label">Net Profit (6M)</p></article>
                </div>

                <div class="analytics-panels">
                    <article class="analytics-panel">
                        <h3 class="analytics-panel__title">Rent Collection Summary</h3>
                        <p class="analytics-panel__subtitle">Collected vs Expected &mdash; Apr to Sep 2024</p>
                        <svg class="analytics-chart" viewBox="0 0 480 180" role="img" aria-label="Expected and collected rent from April to September">
                            <g class="chart-grid"><path d="M42 20H468 M42 48H468 M42 76H468 M42 104H468 M42 132H468" /></g>
                            <g><text x="1" y="23">280k</text><text x="7" y="51">210k</text><text x="7" y="79">140k</text><text x="13" y="107">70k</text><text x="22" y="135">0k</text></g>
                            <g fill="#dfe7f0"><rect x="66" y="31" width="22" height="101" rx="3"/><rect x="126" y="27" width="22" height="105" rx="3"/><rect x="186" y="27" width="22" height="105" rx="3"/><rect x="246" y="26" width="22" height="106" rx="3"/><rect x="306" y="27" width="22" height="105" rx="3"/><rect x="366" y="31" width="22" height="101" rx="3"/></g>
                            <g fill="#0866f5"><rect x="91" y="43" width="22" height="89" rx="3"/><rect x="151" y="37" width="22" height="95" rx="3"/><rect x="211" y="31" width="22" height="101" rx="3"/><rect x="271" y="45" width="22" height="87" rx="3"/><rect x="331" y="38" width="22" height="94" rx="3"/><rect x="391" y="70" width="22" height="62" rx="3"/></g>
                            <g><text x="73" y="148">Apr</text><text x="133" y="148">May</text><text x="193" y="148">Jun</text><text x="253" y="148">Jul</text><text x="313" y="148">Aug</text><text x="373" y="148">Sep</text></g>
                        </svg>
                        <div class="analytics-legend"><span class="analytics-legend__item"><span class="analytics-legend__swatch" style="background:#0866f5"></span>Collected</span><span class="analytics-legend__item"><span class="analytics-legend__swatch" style="background:#dfe7f0"></span>Expected</span></div>
                    </article>

                    <article class="analytics-panel">
                        <h3 class="analytics-panel__title">Occupancy Trend</h3>
                        <p class="analytics-panel__subtitle">Portfolio-wide occupancy rate &mdash; Apr to Sep 2024</p>
                        <svg class="analytics-chart" viewBox="0 0 480 180" role="img" aria-label="Portfolio occupancy trend from April to September">
                            <g class="chart-grid"><path d="M42 20H468 M42 48H468 M42 76H468 M42 104H468 M42 132H468" /></g>
                            <g><text x="5" y="23">100%</text><text x="11" y="51">95%</text><text x="11" y="79">90%</text><text x="11" y="107">85%</text><text x="11" y="135">80%</text></g>
                            <path d="M48 91 C78 86 98 82 126 75 S185 38 212 39 S278 48 307 55 S367 70 392 68 S440 57 462 55" fill="none" stroke="#00bd91" stroke-width="3" stroke-linecap="round" />
                            <g fill="#00bd91" stroke="#fff" stroke-width="2"><circle cx="48" cy="91" r="5"/><circle cx="126" cy="75" r="5"/><circle cx="212" cy="39" r="5"/><circle cx="307" cy="55" r="5"/><circle cx="392" cy="68" r="5"/><circle cx="462" cy="55" r="5"/></g>
                            <g><text x="39" y="151">Apr</text><text x="117" y="151">May</text><text x="203" y="151">Jun</text><text x="298" y="151">Jul</text><text x="383" y="151">Aug</text><text x="453" y="151">Sep</text></g>
                        </svg>
                    </article>

                    <article class="analytics-panel">
                        <h3 class="analytics-panel__title">Income vs Expenses</h3>
                        <p class="analytics-panel__subtitle">Monthly income and operating costs &mdash; Apr to Sep 2024</p>
                        <svg class="analytics-chart" viewBox="0 0 480 180" role="img" aria-label="Monthly income and expenses from April to September">
                            <g class="chart-grid"><path d="M42 20H468 M42 48H468 M42 76H468 M42 104H468 M42 132H468" /></g>
                            <g><text x="1" y="23">280k</text><text x="7" y="51">210k</text><text x="7" y="79">140k</text><text x="13" y="107">70k</text><text x="22" y="135">0k</text></g>
                            <g fill="#0866f5"><rect x="68" y="36" width="22" height="96" rx="3"/><rect x="128" y="30" width="22" height="102" rx="3"/><rect x="188" y="25" width="22" height="107" rx="3"/><rect x="248" y="38" width="22" height="94" rx="3"/><rect x="308" y="32" width="22" height="100" rx="3"/><rect x="368" y="65" width="22" height="67" rx="3"/></g>
                            <g fill="#ff9c9f"><rect x="92" y="104" width="22" height="28" rx="3"/><rect x="152" y="106" width="22" height="26" rx="3"/><rect x="212" y="97" width="22" height="35" rx="3"/><rect x="272" y="101" width="22" height="31" rx="3"/><rect x="332" y="94" width="22" height="38" rx="3"/><rect x="392" y="108" width="22" height="24" rx="3"/></g>
                            <g><text x="75" y="148">Apr</text><text x="135" y="148">May</text><text x="195" y="148">Jun</text><text x="255" y="148">Jul</text><text x="315" y="148">Aug</text><text x="375" y="148">Sep</text></g>
                        </svg>
                        <div class="analytics-legend"><span class="analytics-legend__item"><span class="analytics-legend__swatch" style="background:#ff9c9f"></span>Expenses</span><span class="analytics-legend__item"><span class="analytics-legend__swatch" style="background:#0866f5"></span>Income</span></div>
                    </article>

                    <article class="analytics-panel">
                        <h3 class="analytics-panel__title">Revenue by Property</h3>
                        <p class="analytics-panel__subtitle">September 2024 monthly distribution</p>
                        <div class="property-chart-layout">
                            <svg class="property-chart" viewBox="0 0 120 120" role="img" aria-label="September revenue share by property">
                                <circle cx="60" cy="60" r="45" fill="none" stroke="#edf2f6" stroke-width="18" />
                                <g transform="rotate(-90 60 60)" fill="none" stroke-width="18">
                                    <circle cx="60" cy="60" r="45" stroke="#00bd91" stroke-dasharray="82 201" stroke-dashoffset="0" />
                                    <circle cx="60" cy="60" r="45" stroke="#0866f5" stroke-dasharray="68 215" stroke-dashoffset="-88" />
                                    <circle cx="60" cy="60" r="45" stroke="#9257ed" stroke-dasharray="72 211" stroke-dashoffset="-162" />
                                    <circle cx="60" cy="60" r="45" stroke="#ff9800" stroke-dasharray="50 233" stroke-dashoffset="-240" />
                                </g>
                            </svg>
                            <div class="property-legend">
                                <div class="property-legend__row"><span class="property-legend__name"><span class="analytics-legend__swatch" style="background:#0866f5"></span>Greenview Apts</span><span class="property-legend__value">KES 50,000</span></div>
                                <div class="property-legend__row"><span class="property-legend__name"><span class="analytics-legend__swatch" style="background:#00bd91"></span>Parkside Res.</span><span class="property-legend__value">KES 84,000</span></div>
                                <div class="property-legend__row"><span class="property-legend__name"><span class="analytics-legend__swatch" style="background:#9257ed"></span>Skyline Towers</span><span class="property-legend__value">KES 113,000</span></div>
                                <div class="property-legend__row"><span class="property-legend__name"><span class="analytics-legend__swatch" style="background:#ff9800"></span>Heritage Court</span><span class="property-legend__value">KES 32,000</span></div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </section>
    </main>
</div>
@endsection