App.Models.Watch = Backbone.Model.extend({
	validate: function(attrs) {
		if ( ! attrs.brand_id || ! attrs.model_id ) {
			return 'Model and Brand are required.';
		}
	}
});