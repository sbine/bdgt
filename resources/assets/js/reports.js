function StackedBarChart(element, label) {
  this.element = element;
  this.label = label;
  this.data = {
        labels: [],
        datasets: [{
            label: '',
            backgroundColor: '',
            data: []
        }]
    };
};

StackedBarChart.prototype.initializeChart = function() {
    this.chart = new Chart(this.element, {
        type: 'bar',
        data: this.data,
        options: {
            title: {
                display: true,
                text: this.label
            },
            tooltips: {
                mode: 'label',
                callbacks: {
                    label: function(tooltipItems, data) {
                        return data.datasets[tooltipItems.datasetIndex].label +': ' + '$' + tooltipItems.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                    }
                }
            },
            responsive: true,
            scales: {
                xAxes: [{
                    stacked: true,
                }],
                yAxes: [{
                    stacked: true,
                    ticks: {
                        callback: function(label) {
                            return  '$' + label.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                        }
                    }
                }]
            }
        }
    });
    return this;
}

StackedBarChart.prototype.updateData = function(data) {
    var self = this;
    self.data = data;
    var colors = self.getSemiRandomColors();
    $.each(self.data.datasets, function(i, dataset) {
        var randColor = Math.floor(Math.random() * colors.length);
        dataset.backgroundColor = colors[randColor]; // 'rgba(' + self.randomColor() + ',' + self.randomColor() + ',' + self.randomColor() + ',.7)'
        colors.splice(randColor, 1);
    });
}

StackedBarChart.prototype.redraw = function() {
    if (this.chart !== undefined) {
        this.chart.clear();
    }
    this.initializeChart();
}

StackedBarChart.prototype.getSemiRandomColors = function() {
    return [
        '#4D4D4D',
        '#5DA5DA',
        '#FAA43A',
        '#60BD68',
        '#F17CB0',
        '#B2912F',
        '#B276B2',
        '#DECF3F',
        '#F15854',
    ];
}

StackedBarChart.prototype.randomColor = function() {
    return Math.round(Math.random() * 255);
};

function PieChart(element, label) {
  this.element = element;
  this.label = label;
  this.data = {
        labels: [],
        datasets: [{
            data: [],
            backgroundColor: []
        }]
    };
};

PieChart.prototype.initializeChart = function() {
    this.chart = new Chart(this.element, {
        type: 'pie',
        data: this.data,
        options: {
            title: {
                display: true,
                text: this.label + ' (This Month)'
            },
            tooltips: {
                mode: 'label',
                callbacks: {
                    label: function(tooltipItems, data) {
                        return data.labels[tooltipItems.index] +': ' + '$' + data.datasets[tooltipItems.datasetIndex].data[tooltipItems.index].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                    }
                }
            },
            responsive: true,
        }
    });
    return this;
}

PieChart.prototype.updateData = function(data) {
    var self = this;
    self.data = data;
    var colors = self.getSemiRandomColors();
    $.each(self.data.datasets, function(i, dataset) {
        var backgroundColors = [];
        $.each(dataset.data, function(k, d) {
            var randColor = Math.floor(Math.random() * colors.length);
            backgroundColors.push(colors[randColor]);
            colors.splice(randColor, 1);
        });
        dataset.backgroundColor = backgroundColors;
    });
}

PieChart.prototype.redraw = function() {
    if (this.chart !== undefined) {
        this.chart.clear();
    }
    this.initializeChart();
}

PieChart.prototype.getSemiRandomColors = function() {
    return [
        '#4D4D4D',
        '#5DA5DA',
        '#FAA43A',
        '#60BD68',
        '#F17CB0',
        '#B2912F',
        '#B276B2',
        '#DECF3F',
        '#F15854',
    ];
}

PieChart.prototype.randomColor = function() {
    return Math.round(Math.random() * 255);
};

window.onload = function() {
    var reportName = $('#bdgtReport').data('name');
    var reportUrl = $('#bdgtReport').data('url');

    if (reportUrl !== undefined) {
        if (reportName === 'Spending By Category') {
            window.bdgtReport = new PieChart($("#bdgtReport")[0], reportName);
        } else {
            window.bdgtReport = new StackedBarChart($("#bdgtReport"), reportName);
        }

        $.getJSON(reportUrl, function(json) {
            window.bdgtReport.updateData(json);
            window.bdgtReport.redraw();
        });
    }
};