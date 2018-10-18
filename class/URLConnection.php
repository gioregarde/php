<?php 

/**
 * HTTPSConnection.php
 * 
 * Class for creating http/https connections
 *
 * @author gio regarde <gioregarde@outlook.com>
 */
class URLConnection {

    const HTTP  = 'http://';
    const HTTPS = 'https://';

    const HEADER_CONTENT_TYPE = 'Content-Type';

    const CONTENT_TYPE_JSON = 'application/json';

    const METHOD_GET    = 'GET';
    const METHOD_POST   = 'POST';
    const METHOD_PUT    = 'PUT';
    const METHOD_DELETE = 'DELETE';

    const RETURN_BODY   = 'body';
    const RETURN_STATUS = 'status';

    /**
     * send get request
     *
     * @param object $url       - url location
     * @param object $params    - request parameters
     * @param object $is_https  - is secure connection
     * @return object $response - response object
     */
    function sendGetRequest($url, $params = array(), $is_https = false) {
        return self::sendRequest($url, self::METHOD_GET, $params, array(), $is_https);
    }

    /**
     * send post request
     *
     * @param object $url       - url location
     * @param object $params    - request parameters
     * @param object $headers   - request headers
     * @param object $is_https  - is secure connection
     * @return object $response - response object
     */
    function sendPostRequest($url, $params = array(), $headers = array(), $is_https = false) {
        return self::sendRequest($url, self::METHOD_POST, $params, $headers, $is_https);
    }

    /**
     * send put request
     *
     * @param object $url       - url location
     * @param object $params    - request parameters
     * @param object $headers   - request headers
     * @param object $is_https  - is secure connection
     * @return object $response - response object
     */
    function sendPutRequest($url, $params = array(), $headers = array(), $is_https = false) {
        return self::sendRequest($url, self::METHOD_PUT, $params, $headers, $is_https);
    }

    /**
     * send delete request
     *
     * @param object $url       - url location
     * @param object $params    - request parameters
     * @param object $headers   - request headers
     * @param object $is_https  - is secure connection
     * @return object $response - response object
     */
    function sendDeleteRequest($url, $params = array(), $headers = array(), $is_https = false) {
        return self::sendRequest($url, self::METHOD_DELETE, $params, $headers, $is_https);
    }

    /**
     * send request
     *
     * @param object $url       - url location
     * @param object $method    - request method (refer to constant METHOD_*)
     * @param object $params    - request parameters
     * @param object $headers   - request headers
     * @param object $is_https  - is secure connection
     * @return object $response - response object
     */
    function sendRequest($url, $method = self::METHOD_GET, $params = array(), $headers = array(), $is_https = false) {
        $response = array();

        if (strpos($url, self::HTTPS) !== false) {
            $is_https = true;
        } else if (strpos($url, self::HTTP) === false) {
            $url = $is_https ? self::HTTPS.$url : self::HTTP.$url;
        }

        if ($params) {
            if ($method == self::METHOD_GET) {
                $url .= strpos($url, '?') !== false ? http_build_query($params) : '?'.http_build_query($params);
            } else if ($method == self::METHOD_POST) {
                if (isset($headers[self::HEADER_CONTENT_TYPE]) && $headers[self::HEADER_CONTENT_TYPE] == self::CONTENT_TYPE_JSON) {
                    $params = json_encode($params);
                } else {
                    $params = http_build_query($params);
                }
            }
        }

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

        if ($method == self::METHOD_PUT || $method == self::METHOD_DELETE) { // custom method request (check if possible)
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        }

        if ($is_https) {
            curl_setopt($curl, CURLOPT_SSLVERSION, 6);
        }

        if ($headers) {
            curl_setopt($curl, CURLOPT_HEADER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        }

        if ($params && $method == self::METHOD_POST) {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        }

        $response[self::RETURN_BODY] = curl_exec($curl);
        $response[self::RETURN_STATUS] = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($response[self::RETURN_STATUS] != 200) { 
            // TODO handle error (throw exception)
        }

        return $response;
    }

}

?>