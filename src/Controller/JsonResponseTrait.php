<?php

namespace JsonApi\App\Controller;

trait JsonResponseTrait
{

    /**
     * This function is the root function for building a proper JSON response.
     * Takes a status code (from one of the public methods), a message, and the data array
     * and builds a standardized API response.
     *
     * The JSON response will look like
     * {
     *    'message' : 'message to the user relative to the status code',
     *    'data'    : [ .. json encoded data array - uses Cake JSONView _serialize magic .. ]
     * }
     * @param type string $statusCode
     * @param type string $message
     * @param type array $data
     * @return type
     */
    protected function respondWith($statusCode, $message = '', array $data = [])
    {
        $this->response->header('Status', $statusCode);
        $this->set('data', $data);
        $this->set('message', $message);
        $this->set('_serialize', ['data', 'message']);

        return $this->render();
    }

    /**
     * 200 - OK
     * General status code. Most common code used to indicate success.
     *
     * @param string $message
     * @param array $data
     * @return
     */
    public function respondWithOK($message = '', array $data = [])
    {
        $this->respondWith('200', $message, $data);
    }

    /**
     * 201 - CREATED
     * Successful creation occurred (via either POST or PUT). Set the Location header to contain a link to the newly-created resource (on POST). Response body content may or may not be present.
     *
     * @param string $message
     * @param array $data
     * @return
     */
    public function respondWithCreated($message = '', array $data = [])
    {
        $this->respondWith('201', $message, $data);
    }

    /**
     * 204 - NO CONTENT
     * Indicates success but nothing is in the response body, often used for DELETE and PUT operations.
     *
     * @param string $message
     * @param array $data
     * @return
     */
    public function respondWithNoContent($message = '', array $data = [])
    {
        $this->respondWith('204', $message, $data);
    }

    /**
     * 400 - BAD REQUEST
     * General error when fulfilling the request would cause an invalid state. Domain validation errors, missing data, etc. are some examples.
     *
     * @param string $message
     * @param array $data
     * @return
     */
    public function respondWithBadRequest($message = '', array $data = [])
    {
        $this->respondWith('400', $message, $data);
    }

    /**
     * 401 - UNAUTHORIZED
     * Error code response for missing or invalid authentication token.
     *
     * @param string $message
     * @param array $data
     * @return
     */
    public function respondWithUnauthorized($message = '', array $data = [])
    {
        $this->respondWith('401', $message, $data);
    }

    /**
     * 403 - FORBIDDEN
     * Error code for user not authorized to perform the operation or the resource is unavailable for some reason (e.g. time constraints, etc.).
     *
     * @param string $message
     * @param array $data
     * @return
     */
    public function respondWithForbidden($message = '', array $data = [])
    {
        $this->respondWith('403', $message, $data);
    }

    /**
     * 404 - NOT FOUND
     * Used when the requested resource is not found, whether it doesn't exist or if there was a 401 or 403 that, for security reasons, the service wants to mask.
     *
     * @param string $message
     * @param array $data
     * @return
     */
    public function respondWithNotFound($message = '', array $data = [])
    {
        $this->respondWith('404', $message, $data);
    }

    /**
     * 405 - METHOD NOT ALLOWED
     * Used to indicate that the requested URL exists, but the requested HTTP method is not applicable. For example, POST /users/12345 where the API doesn't support creation of resources this way (with a provided ID). The Allow HTTP header must be set when returning a 405 to indicate the HTTP methods that are supported. In the previous case, the header would look like "Allow: GET, PUT, DELETE"
     *
     * @param string $message
     * @param array $data
     * @return
     */
    public function respondWithMethodNotAllowed($message = '', array $data = [])
    {
        $this->respondWith('405', $message, $data);
    }

    /**
     * 409 - CONFLICT
     * Whenever a resource conflict would be caused by fulfilling the request. Duplicate entries, such as trying to create two customers with the same information, and deleting root objects when cascade-delete is not supported are a couple of examples.
     *
     * @param string $message
     * @param array $data
     * @return
     */
    public function respondWithConflict($message = '', array $data = [])
    {
        $this->respondWith('409', $message, $data);
    }

    /**
     * 500 - INTERNAL SERVER ERROR
     * The server encountered an unexpected condition which prevented it from fulfilling the request. Should ONLY be used when unhandled exception occurs.
     *
     * @param string $message
     * @param array $data
     * @return
     */
    public function respondWithInternalServerError($message = '', array $data = [])
    {
        $this->respondWith('500', $message, $data);
    }
}
