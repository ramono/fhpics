fhpics
======

A Statamic plugin to pull photos from 500px. The plugin requires the use of a consumer key, which you can obtain by visiting http://500px.com/settings/applications and registering a new application.

## Photo feed
### Options
- consumer_key: Your API consumer key, (required).
- feature: The type of photo stram to request, it default to user, (optional).
- user: username to pull photos from, (required only if feature is set to `user`, `user_friends` or `user_favorites`).
- count: Amount of photos to request, defaults to 5, (optional).
- image_size: size of the image to be shown, it defaults to 3 (280 x 280), (optional).
- sort: Sort photos in the specified order, (optional).
- only: String name of the category to return photos from, (optional).
- exclude: String name of the category to exclude photos by, (optional).

### Sample
	{{ fhpics:photos count="8" consumer_key="<your_key>" user="<username>" }}   
		{{ photos }}
		<a href="http://www.500px.com{{ url }}"><img src="{{ image_url }}" alt="{{ name }}"></a>
		{{ /photos }}  
	{{ /fhpics:photos }}	

For more information on option values and response format please check https://github.com/500px/api-documentation/blob/master/endpoints/photo/GET_photos.md

## Individual photo
### Options: 
- consumer_key: Your API consumer key, (required).
- id: ID of the image, (required).
- image_size: size of the image to be shown, it defaults to 3 (280 x 280), (optional).
- comments: Pull image comments, if omitted comments are not available, (optional).

### Sample
	{{ fhpics:photo id="<photo_id>" image_size="3" comments="1" consumer_key="<your_key>" }}
	<p><a href="http://www.500px.com{{ url }}"><img src="{{ image_url }}" alt="{{ name }}"></a></p>
	<p>Description:  {{ description }} - {{ camera }} {{ shutter_speed }}s f{{ aperture }} ISO{{ iso }}</p>
	<ul>
		{{ comments }}
		<li><a href="http://www.500px.com/{{ user.username }} ">{{ user.fullname }}</a>: {{ body }}</li>
		{{ /comments }}
	</ul>
	{{ /fhpics:photo }}	

For more information on option values for the individual photo, and response format please check https://github.com/500px/api-documentation/blob/master/endpoints/photo/GET_photos_id.md

Please note that not all options shown in the documentation have been implemented in this plugin, if you have a request, please get in touch or log an issue here. Thanks.

