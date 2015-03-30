<?php

namespace UserScape\HelpSpot;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Message\RequestInterface;

class Transport
{
    use Mixin\CloneWithMixin;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $password;

    /**
     * @return string
     */
    public function url()
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return static
     */
    public function withUrl($url)
    {
        return $this->cloneWith("url", $url);
    }

    /**
     * @return string
     */
    public function email()
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return static
     */
    public function withEmail($email)
    {
        return $this->cloneWith("email", $email);
    }

    /**
     * @return string
     */
    public function password()
    {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @return static
     */
    public function withPassword($password)
    {
        return $this->cloneWith("password", $password);
    }

    /**
     * @param string $url
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Attempts an API request, after adding auth, body and query string parameters.
     *
     * @param string $method
     * @param string $endpoint
     * @param array  $parameters
     *
     * @return mixed
     */
    public function request($method, $endpoint, array $parameters = [])
    {
        $parameters["output"] = "json";
        $parameters["method"] = $endpoint;

        $options = [];
        $options = $this->optionsWithAuth($options);
        $options = $this->optionsWithBody($options, $method, $parameters);

        $client = new GuzzleClient();

        $request = $client->createRequest($method, $this->url . "/api/index.php", $options);
        $request = $this->requestWithQueryString($request, $method, $endpoint, $parameters);

        $body = $this->tryRequest($client, $request);

        return json_decode($body, true);
    }

    /**
     * Returns a new options array, with auth parameters added.
     *
     * @param array $options
     *
     * @return array
     */
    protected function optionsWithAuth(array $options)
    {
        if ($this->email and $this->password) {
            $options["auth"] = [$this->email, $this->password];
        }

        return $options;
    }

    /**
     * Returns a new options array, with request body parameters added.
     *
     * @param array  $options
     * @param string $method
     * @param array  $parameters
     *
     * @return array
     */
    protected function optionsWithBody(array $options, $method, array $parameters)
    {
        if ($method === "POST" or $method === "PUT" or $method === "PATCH") {
            $options["body"] = http_build_query($parameters);
        }

        return $options;
    }

    /**
     * Returns a new request, with query string parameters added.
     *
     * @param RequestInterface $request
     * @param string           $method
     * @param string           $endpoint
     * @param array            $parameters
     *
     * @return RequestInterface
     */
    protected function requestWithQueryString(RequestInterface $request, $method, $endpoint, array $parameters)
    {
        $clone = clone $request;

        $query = $clone->getQuery();

        $query->set("method", $endpoint);

        if ($method === "GET" or $method === "DELETE") {
            foreach ($parameters as $key => $value) {
                $query->set($key, $value);
            }
        }

        return $clone;
    }

    /**
     * Attempts an API request, returning the body even for non-200 responses.
     *
     * Returns null if the request didn't get a response.
     *
     * @param GuzzleClient     $client
     * @param RequestInterface $request
     *
     * @return null|string
     */
    protected function tryRequest(GuzzleClient $client, RequestInterface $request)
    {
        $body = null;

        try {
            $body = (string) $client->send($request);
        } catch (RequestException $exception) {
            if ($exception->hasResponse()) {
                $body = (string) $exception->getResponse()->getBody();
            }
        }

        return $body;
    }
}
