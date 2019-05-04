( function( api ) {

	// Extends our custom "vivah-royal-wedding" section.
	api.sectionConstructor['vivah-royal-wedding'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );