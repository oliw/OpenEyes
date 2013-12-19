/**
 * (C) OpenEyes Foundation, 2014
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (C) 2014, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */

(function (exports) {
	'use strict';

	function render(chart_id, series, options, yaxis_labels, point_labels) {
		var plot = $.plot(document.getElementById(chart_id), series, options),
			xaxis = options.xaxis;

		addAxisLabels(plot, options.yaxes, yaxis_labels);
		addSlider(plot, xaxis.panRange[0], xaxis.panRange[1], [xaxis.min, xaxis.max], xaxis.zoomRange[0]);
		addTooltips(plot, point_labels);
	}

	function addAxisLabels(plot, yaxes, yaxis_labels) {
		var left_label = '', right_label = '';

		for (var i = 0; i < yaxes.length; i++) {
			if (yaxis_labels[i]) {
				if (yaxes[i].position == 'right') {
					right_label = yaxis_labels[i];
				} else {
					left_label = yaxis_labels[i];
				}
			}
		}

		var labels = $(
			'<div class="row">' +
			'<div class="column small-6"><span class="data-value">' + left_label + '</span></div>' +
			'<div class="column small-6"><span class="data-value right">' + right_label + '</span></div>' +
			'</div>'
		);

		labels.insertAfter(plot.getPlaceholder());
	}

	function addSlider(plot, x_min, x_max, values, min_range) {
		var slider = $('<div></div>');
		slider.slider({
			min: x_min,
			max: x_max,
			range: true,
			values: values,
		});

		var xaxis = plot.getOptions().xaxes[0];

		plot.getPlaceholder().on("plotpan plotzoom", function () {
			slider.slider("values", [xaxis.min, xaxis.max]);
		});

		function syncPlot(min, max) {
			xaxis.min = min;
			xaxis.max = max;
			plot.setupGrid();
			plot.draw();
		}

		slider.on("slide", function (event, ui) {
			var min = ui.values[0],
			max = ui.values[1],
			ret = true;

			if (min == max) return false;

			if (max - min <= min_range) {
				if (min == ui.value) {
					min = max - min_range;
				} else {
					max = min + min_range;
				}
				slider.slider("values", [min, max]);
				ret = false;
			}

			syncPlot(min, max);

			return ret;
		});

		var slide_bar = slider.find('.ui-slider-range');
		slide_bar.draggable({
			axis: "x",
			containment: "parent",
		});
		slide_bar.on("drag", function (e, ui) {
			if (!ui) return;

			var values = slider.slider("values");

			if (values[0] == x_min && values[1] == x_max) return false;

			// This is a nasty hack that messes with the internals of the slider widget,
			// but the alternative is to duplicate the code that converts offsets into values
			var widget = slider.data('ui-slider');
			widget.elementSize = {
				width: widget.element.outerWidth(),
				height: widget.element.outerHeight()
			};
			widget.elementOffset = widget.element.offset();

			var width = values[1] - values[0],
			min = Math.max(widget._normValueFromMouse({x: ui.offset.left}), x_min),
			max = Math.min(min + width, x_max);

			slider.slider("values", [min, max]);
			syncPlot(min, max);
		});
		slide_bar.on("dblclick", function () {
			slider.slider("values", [x_min, x_max]);
			syncPlot(x_min, x_max);
		});

		slider.insertAfter(plot.getPlaceholder());
	}

	function addTooltips(plot, point_labels) {
		var tooltip = $('<div class="quicklook tooltip" style="position: absolute; display: none;"></div').appendTo('body');

		var hoverItem = null;
		plot.getPlaceholder().on("plothover", function (e, pos, item) {
			if (item) {
				if (item != hoverItem) {
					var label = point_labels[item.series.label][item.dataIndex];
					if (label) {
						tooltip.css('left', item.pageX + 10).css('top', item.pageY + 10).html(label).show();
					} else {
						tooltip.hide();
					}
					hoverItem = item;
				}
			} else {
				tooltip.hide();
				hoverItem = null;
			}
		}).mouseout(function (e) {
			tooltip.hide();
			hoverItem = null;
		});
	}

	exports.FlotChart = {
		render: render,
	};
}(this.OpenEyes.UI.Widgets));
