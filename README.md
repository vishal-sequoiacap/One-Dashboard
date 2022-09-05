# One Dashboard Theme
This theme is not providing any front-end functionality, it's just registering one custom taxonomy and handling rest api call.

## REST API  endpoint handling

- User must need to pass the `{site=ID}` in the rest api call to fetch the posts.

-----------

### Posts List:

Description:
- Query this endpoint to retrieve a collection posts which are having particular site id.
   
Definition: 
- `GET /wp/v2/posts?site=Term_ID`

Example Request:
- $ curl `https://example.com/wp-json/wp/v2/posts?site=3`

-----------

### Posts List Endpoint With Category Filter:

Description:
- Query this endpoint to retrieve a collection posts which are having particular site id and category ids.

Definition:
- `GET /wp/v2/posts?site=Term_ID&categories=Category_ID`

Example Request:
- $ curl `https://example.com/wp-json/wp/v2/posts?site=3&categories=7`

-----------

### Posts Search:

Description:
- Query this endpoint to retrieve a collection posts which are having particular site id and with search term query.

Definition:
- `GET /wp/v2/search?search=SEARCH_TERM&site=Term_ID`

Example Request:
- $ curl `https://example.com/wp-json/wp/v2/search?search=hello&site=3`

-----------

### Category Search:

Description:
- Query this endpoint to retrieve a collection of categories. The response you receive can be controlled and filtered using the URL query parameters below.

Definition:
- `GET /wp/v2/categories`

Example Request:
- $ curl `https://example.com/wp-json/wp/v2/categories`

-----------

**NOTE:** `site=ID` is the required param on the above REST API endpoints, if user not pass the `site` param than it will show an error.

-----------

### Reference:
- For more details see rest api documentation - https://developer.wordpress.org/rest-api/reference/
