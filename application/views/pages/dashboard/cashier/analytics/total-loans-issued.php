<div class="card">
    <div class="card-header header-elements">
        <h5 class="card-title mb-0">Average Skills</h5>
        <div class="card-header-elements ms-auto py-0 dropdown">
            <button type="button" class="btn dropdown-toggle hide-arrow p-0" id="heat-chart-dd"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bx bx-dots-vertical-rounded"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="heat-chart-dd">
                <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <canvas id="polarChart" class="chartjs" data-height="337"></canvas>
    </div>
</div>