(function () {
	'use strict';

	document.addEventListener('DOMContentLoaded', function () {
		var items = document.querySelectorAll('.pillar-faq__item');

		items.forEach(function (item) {
			var question = item.querySelector('.pillar-faq__question');
			if (!question) {
				return;
			}

			question.addEventListener('click', function () {
				var isOpen = item.classList.contains('is-open');

				items.forEach(function (other) {
					other.classList.remove('is-open');
					var otherQuestion = other.querySelector('.pillar-faq__question');
					if (otherQuestion) {
						otherQuestion.setAttribute('aria-expanded', 'false');
					}
				});

				if (!isOpen) {
					item.classList.add('is-open');
					question.setAttribute('aria-expanded', 'true');
				}
			});
		});
	});
})();