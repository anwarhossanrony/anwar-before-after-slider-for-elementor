
(function () {
	'use strict';

	function updateCompare(compare, value) {
		var percentage = Math.max(0, Math.min(100, parseFloat(value) || 50));
		var before = compare.querySelector('.basfe-image-before');
		var after = compare.querySelector('.basfe-image-after');
		var divider = compare.querySelector('.basfe-divider');
		var range = compare.querySelector('.basfe-range');

		if (before) {
			before.style.width = percentage + '%';
		}

		if (after) {
			after.style.left = percentage + '%';
			after.style.width = (100 - percentage) + '%';
		}

		if (divider) {
			divider.style.left = percentage + '%';
		}

		if (range && parseFloat(range.value) !== percentage) {
			range.value = percentage;
		}
	}

	function bindCompare(compare) {
		if (!compare || compare.dataset.basfeReady === '1') {
			return;
		}

		var range = compare.querySelector('.basfe-range');
		if (!range) {
			return;
		}

		var start = compare.getAttribute('data-start') || range.value || 50;
		updateCompare(compare, start);

		range.addEventListener('input', function () {
			updateCompare(compare, range.value);
		});

		range.addEventListener('change', function () {
			updateCompare(compare, range.value);
		});

		compare.dataset.basfeReady = '1';
	}

	function init(root) {
		var scope = root || document;
		var widgets = scope.querySelectorAll('.basfe-compare');
		widgets.forEach(bindCompare);
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', function () {
			init(document);
		});
	} else {
		init(document);
	}

	if (window.elementorFrontend && window.elementorFrontend.hooks) {
		window.elementorFrontend.hooks.addAction('frontend/element_ready/global', function ($scope) {
			if ($scope && $scope[0]) {
				init($scope[0]);
			}
		});
	}
})();
