# One Dashboard Theme
This theme is not providing any front-end functionality, it's just registering one custom taxonomy and handling rest api call.

**NOTE:** We will be using [JWT Authentication for WP REST API](https://wordpress.org/plugins/jwt-authentication-for-wp-rest-api/) plugin on the server's end to restrict the rest api to be used with the JWT token for any rest api request. Below are the few steps to setup it on the client's end.

## Setup on Server's end

- Update `.htaccess` and `wp-config.php` files as describe in plugin's doc - https://wordpress.org/plugins/jwt-authentication-for-wp-rest-api/#tab-description

## Setup on Client's end

- First generate JWT auth token by below REST API call.

#### Generate JWT Token:

Description:
- Generate JWT token.

Definition:
- `POST /jwt-auth/v1/token`

Example Request:
- $ curl `https://example.com/wp-json/jwt-auth/v1/token` - We need to send the username and password in the post method submission to get token.

**NOTE:** The token which is generated in the above request, that we need to pass in the below all requests as the Authorization Bearer header, without passing this token the REST API request will not serve the data.

**Postman:** We have also generated a postman json file(available in root directory - `JWT-Auth.postman_collection.json`), you can directly import it in the postman, replace your local site's domain in that, and you can test all WP REST api endpoints. Just make sure you will use the latest JWT token from the token request in this demo file. 

### REST API  endpoint handling

- User must need to pass the `{site=ID}` in the rest api call to fetch the posts.

-----------

#### Posts List:

Description:
- Query this endpoint to retrieve a collection posts which are having particular site id.
   
Definition: 
- `GET /wp/v2/posts?site=Term_ID` - Also we need to include the JWT with this request as Authorization header.

Example Request:
- $ curl `https://example.com/wp-json/wp/v2/posts?site=3`

-----------

#### Posts List Endpoint With Category Filter:

Description:
- Query this endpoint to retrieve a collection posts which are having particular site id and category ids.

Definition:
- `GET /wp/v2/posts?site=Term_ID&categories=Category_ID` - Also we need to include the JWT with this request as Authorization header.

Example Request:
- $ curl `https://example.com/wp-json/wp/v2/posts?site=3&categories=7`

-----------

#### Posts Search:

Description:
- Query this endpoint to retrieve a collection posts which are having particular site id and with search term query.

Definition:
- `GET /wp/v2/search?search=SEARCH_TERM&site=Term_ID` - Also we need to include the JWT with this request as Authorization header.

Example Request:
- $ curl `https://example.com/wp-json/wp/v2/search?search=hello&site=3`

-----------

#### Category Search:

Description:
- Query this endpoint to retrieve a collection of categories. The response you receive can be controlled and filtered using the URL query parameters below.

Definition:
- `GET /wp/v2/categories` - Also we need to include the JWT with this request as Authorization header.

Example Request:
- $ curl `https://example.com/wp-json/wp/v2/categories`

-----------

**NOTE:** `site=ID` is the required param on the above REST API endpoints, if user not pass the `site` param than it will show an error.

-----------

### Reference:
- For more details see rest api documentation - https://developer.wordpress.org/rest-api/reference/
