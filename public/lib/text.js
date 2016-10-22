
			// search by degree award
			var awards = $.parseJSON(val.certificate);
			angular.forEach(y.selected_opts.degree_award, function (award) {
				// checking to see if the award is in the array of courses
				if ($.inArray(award, awards) !== -1 || awards === null) bool |= true;
			});
			console.log('after awards! ', bool);
			
			// search by discipline
			if ((y.selected_opts.faculties.length === 0)) {
				//bool |= true;
				console.log('here 1', bool);
			} else if ($.inArray(val.faculty, y.selected_opts.faculties) !== -1) {
				bool &= true;
				console.log('here 2', bool);
			} else {
				bool &= false;
				console.log('here 3', bool);
			}
			
			console.log('after discipline! ', bool, y.selected_opts.faculties.length);
			
			// search by amount
			// firstly get who it is applying to
			if (y.pricing.applies.value === 1) {
				// international students
				bool &=  (val.intl >= y.pricing.minimum.value && val.intl <= y.pricing.maximum.value);
			} else {
				// local students
				bool &= (val.local >= y.pricing.minimum.value && val.local <= y.pricing.maximum.value);
			}
			
			console.log('after amount! ', bool);
			
			// study type part
			if (val.variant_name !== "---"  && val.variant_name.length >= 1) {
				var variant = val.variant_name.variants;
				angular.forEach(variant, function (v) {
					if ($.inArray(v, y.selected_opts.variants)) bool |= true;
				});
			}
			