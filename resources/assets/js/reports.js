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
    $.each(self.data.datasets, function(i, dataset) {
        dataset.backgroundColor = 'rgba(' + self.randomColor() + ',' + self.randomColor() + ',' + self.randomColor() + ',.7)';
    });
}

StackedBarChart.prototype.redraw = function() {
    if (this.chart !== undefined) {
        this.chart.clear();
    }
    this.initializeChart();
}

StackedBarChart.prototype.randomColor = function() {
    return Math.round(Math.random() * 255);
};

window.onload = function() {
    var reportName = $('#bdgtReport').data('name');
    var reportUrl = $('#bdgtReport').data('url');

    if (reportUrl !== undefined) {
        window.bdgtReport = new StackedBarChart($("#bdgtReport"), reportName);

        $.getJSON(reportUrl, function(json) {
            window.bdgtReport.updateData(json);
            window.bdgtReport.redraw();
        });
    }
};